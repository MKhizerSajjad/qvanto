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

            $vendorID = Auth::user()->user_type == 2 ? Auth::user()->id : null;
            $vendorId = request()->get('vendor');
            $leadType = request()->get('lead_type');
            $status = request()->get('status');
            $fromDate = request()->get('from');
            $toDate = request()->get('to');

            // Filter Clousre
            $filters = function ($query) use ($vendorID, $vendorId, $status, $leadType, $fromDate, $toDate) {
                if ($vendorID) {
                    $query->where('vendor_id', $vendorID);
                }
                if ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                }
                if ($status) {
                    $query->where('status', $status);
                }
                if ($leadType) {
                    $query->where('lead_type', $leadType);
                }
                if ($fromDate) {
                    $query->whereDate('dated', '>=', $fromDate);
                }
                if ($toDate) {
                    $query->whereDate('dated', '<=', $toDate);
                }
            };

            // For Filters
            $vendors = Vendor::where('status', 1)->whereIn('user_type', [2])->select('id', 'first_name', 'last_name')->get();

            // Tiles Counts
            $count = new \stdClass();
            $count->vendor = Vendor::when($vendorID, function ($query) use ($vendorID) {
                    return $query->where('id', $vendorID);
                })
                ->where('user_type', 2)
                ->count();


            $count->leadTotal = Lead::query()->tap($filters)->count();

            $count->leadPending = Lead::query()->tap($filters)->whereNotIn('status', [1,2,7])->count();

            $count->leadResolved = Lead::query()->tap($filters)->whereIn('status', [1,2,7])->count();

            // Make status based sql
            $statusMappings = getLeadStatus(null, null);
            $caseStatements = [];
            $caseStatements2 = [];
            $topVendorsStat = [];
            foreach ($statusMappings as $key => $label) {
                ++$key;
                $caseStatements[] = "WHEN status = {$key} THEN '{$label}'";
                $caseStatements2[] =  "SUM(CASE WHEN status = {$key} THEN 1 ELSE 0 END) as `{$label}`";
                $topVendorsStat[] = "SUM(CASE WHEN leads.status = {$key} THEN 1 ELSE 0 END) as `{$label}`";
            }
            $caseSql = implode(" ", $caseStatements);
            $caseSql2 = implode(", ", $caseStatements2);
            $topVendorsSql = implode(", ", $topVendorsStat);

            // Round Graph
            $caseStatusCounts = DB::table('leads')
            ->select(
                'status',
                DB::raw('count(*) as count'),
                DB::raw("CASE {$caseSql} ELSE 'Unknown' END as label")
            )
            ->tap($filters)
            ->groupBy('status')->get();


            // Query to get total cases and status counts
            $caseStatusCounts2 = DB::table('leads')
                ->selectRaw(
                    'DATE_FORMAT(dated, "%Y-%m-%d") as date,
                    DATE_FORMAT(dated, "%Y") as year,
                    DATE_FORMAT(dated, "%m") as month,
                    count(*) as total_cases,
                    ' . $caseSql2
                )
                ->tap($filters)
                ->groupBy('year', 'month', 'date') // Group by date, year, and month
                ->orderBy('date', 'asc')
                ->get();

            $topVendors = Vendor::with(['leads' => function($q) use ($topVendorsSql) {
                $q->select('vendor_id', DB::raw("
                    COUNT(*) as total,
                    {$topVendorsSql}
                "))
                ->groupBy('vendor_id');
            }])
            ->where('id', '!=', Auth::user()->id)
            ->where('user_type', 2)
            ->withCount('leads') // Add this line to count leads
            ->orderBy('leads_count', 'desc') // Order by the count of leads
            ->take(10) // Limit to the top 10
            ->get();

            return view('admin.dashboard', compact('vendors', 'count', 'caseStatusCounts', 'caseStatusCounts2', 'statusMappings', 'topVendors'));

        } else {
            return view('admin.dashboard');
        }

    }
}
