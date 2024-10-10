<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Lead;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->user_type != 3) {

            $vendorID = null; // Initialize the variable

            if(Auth::user()->user_type ==2) {
                $vendorID = Auth::user()->id;
            }

            $count = json_decode('{}');
            $count->vendor = Vendor::count();
            $count->leadTotal = Lead::count();
            $count->leadPeding = Lead::where('status', '!=', 7)->count();
            $count->leadResolved = Lead::where('status', 7)->count();

            // Get from helper to make cases status dynamic
            $statusMappings = getLeadStatus(null, null);
            $caseStatements = [];
            foreach ($statusMappings as $status => $label) {
                $caseStatements[] = "WHEN status = {$status} THEN '{$label}'";
            }
            $caseSql = implode(" ", $caseStatements);

            $caseStatusCounts = DB::table('leads')
            ->select(
                'status',
                DB::raw('count(*) as count'),
                DB::raw("CASE {$caseSql} ELSE 'Unknown' END as label")
            )
            ->when(isset($vendorID), function ($query) use ($vendorID) {
                return $query->where('id', $vendorID);
            })
            ->groupBy('status')->get();



            $caseStatusCounts2 = DB::table('leads')
            ->select(
                DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'),
                DB::raw('DATE_FORMAT(dated, "%Y") as year'),
                DB::raw('DATE_FORMAT(dated, "%m") as month'),
                DB::raw('count(*) as total_cases'),
                DB::raw('SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) as resolved_cases')
            )
            ->when(isset($vendorID), function ($query) use ($vendorID) {
                return $query->where('id', $vendorID);
            })
            ->groupBy('year', 'month', 'date')->get();


            $caseStatusCounts3 = DB::table('cases')
            ->select(
                DB::raw('DATE_FORMAT(start_datetime, "%Y-%m-%d") as date'),
                DB::raw('DATE_FORMAT(start_datetime, "%Y") as year'),
                DB::raw('DATE_FORMAT(start_datetime, "%m") as month'),
                'status',
                DB::raw('count(*) as count'),
                DB::raw("CASE
                    WHEN status = 1 THEN 'Process Start'
                    WHEN status = 2 THEN 'Under observation'
                    WHEN status = 3 THEN 'Negotiating'
                    WHEN status = 4 THEN 'Waiting for customer response'
                    WHEN status = 6 THEN 'Waiting for 3rd party response'
                    WHEN status = 7 THEN 'Suspended'
                    WHEN status = 8 THEN 'Withdrawed'
                    WHEN status = 9 THEN 'Resolved'
                    ELSE 'Unknown'
                END as label"),
            )
            ->when(isset($vendorID), function ($query) use ($vendorID) {
                return $query->where('employee_id', $vendorID);
            })
            ->groupBy('year', 'month', 'date', 'status')
            ->get();

            $casesAmounts = Cases::selectRaw('DATE(start_datetime) as date')
            ->selectRaw('SUM(total_amount) as total_amount')
            ->selectRaw('SUM(commission_amount) as commission_amount')
            ->selectRaw('SUM(total_amount - commission_amount) as profit_amount')
            ->when(isset($vendorID), function ($query) use ($vendorID) {
                return $query->where('employee_id', $vendorID);
            })
            ->groupBy('date')
            ->orderBy('date')
            ->get();


            $statusMappings = getLeadStatus(null, null);
            $caseStatements = [];
            foreach ($statusMappings as $status => $label) {
                $caseStatements[] = "SUM(CASE WHEN leads.status = {$status} THEN 1 ELSE 0 END) as `{$label}`";
            }
            $caseSql = implode(", ", $caseStatements);

            $topVendors = Vendor::with(['leads' => function($q) use ($caseSql) {
                $q->select('vendor_id', DB::raw("
                    COUNT(*) as total,
                    {$caseSql}
                "))
                ->groupBy('vendor_id');
            }])
            ->where('id', '!=', Auth::user()->id)
            ->where('user_type', 2)
            ->withCount('leads') // Add this line to count leads
            ->orderBy('leads_count', 'desc') // Order by the count of leads
            ->take(10) // Limit to the top 10
            ->get();

            return view('admin.dashboard', compact('count', 'caseStatusCounts', 'caseStatusCounts2', 'caseStatusCounts3', 'casesAmounts', 'topVendors'));

        } else {
            return view('admin.dashboard');
        }
    }
}
