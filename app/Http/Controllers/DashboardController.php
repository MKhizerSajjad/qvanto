<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Cases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->user_type != 3) {

            $employeeID = null; // Initialize the variable

            if(Auth::user()->user_type ==2) {
                $employeeID = Auth::user()->id;
            }

                // $totalCases = Cases::groupBy('status')->count();
                // $resolvedCases = Cases::where('status', 9)->count();

                // $caseStatusCounts = Cases::select('status', DB::raw('count(*) as count'))
                //     ->groupBy('status')
                //     ->pluck('count', 'status')
                //     ->all();


                    
            $caseStatusCounts = DB::table('cases')
            ->select(
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
                // DB::raw("CASE
                //     WHEN status = 1 THEN '<span class=\"badge bg-info-light\">Process Start</span>'
                //     WHEN status = 2 THEN '<span class=\"badge bg-secondary-light\">Under observation</span>'
                //     WHEN status = 3 THEN '<span class=\"badge bg-info-light\">Negotiating</span>'
                //     WHEN status = 4 THEN '<span class=\"badge bg-warning-light\">Waiting for customer response</span>'
                //     WHEN status = 6 THEN '<span class=\"badge bg-warning-light\">Waiting for 3rd party response</span>'
                //     WHEN status = 7 THEN '<span class=\"badge bg-danger-light\">Suspended</span>'
                //     WHEN status = 8 THEN '<span class=\"badge bg-primary-light\">Withdrawed</span>'
                //     WHEN status = 9 THEN '<span class=\"badge bg-success-light\">Resolved</span>'
                //     ELSE ''
                // END as badge")
            )
            ->when(isset($employeeID), function ($query) use ($employeeID) {
                return $query->where('employee_id', $employeeID);
            })
            ->groupBy('status')->get();

            // $caseStatusCounts2 = DB::table('cases')
            // ->select(
            //     DB::raw('DATE_FORMAT(start_datetime, "%Y-%m-%d") as date'),
            //     DB::raw('DATE_FORMAT(start_datetime, "%Y") as year'),
            //     DB::raw('DATE_FORMAT(start_datetime, "%m") as month'),
            //     'status',
            //     DB::raw('count(*) as count'),
            //     DB::raw("CASE
            //         WHEN status = 1 THEN 'Process Start'
            //         WHEN status = 2 THEN 'Under observation'
            //         WHEN status = 3 THEN 'Negotiating'
            //         WHEN status = 4 THEN 'Waiting for customer response'
            //         WHEN status = 6 THEN 'Waiting for 3rd party response'
            //         WHEN status = 7 THEN 'Suspended'
            //         WHEN status = 8 THEN 'Withdrawed'
            //         WHEN status = 9 THEN 'Resolved'
            //         ELSE 'Unknown'
            //     END as label"),
            // )
            // ->groupBy('year', 'month', 'date', 'status')
            // ->get();


            $caseStatusCounts2 = DB::table('cases')
            ->select(
                DB::raw('DATE_FORMAT(start_datetime, "%Y-%m-%d") as date'),
                DB::raw('DATE_FORMAT(start_datetime, "%Y") as year'),
                DB::raw('DATE_FORMAT(start_datetime, "%m") as month'),
                DB::raw('count(*) as total_cases'),
                DB::raw('SUM(CASE WHEN status = 9 THEN 1 ELSE 0 END) as resolved_cases')
            )
            ->when(isset($employeeID), function ($query) use ($employeeID) {
                return $query->where('employee_id', $employeeID);
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
            ->when(isset($employeeID), function ($query) use ($employeeID) {
                return $query->where('employee_id', $employeeID);
            })
            ->groupBy('year', 'month', 'date', 'status')
            ->get();

            $casesAmounts = Cases::selectRaw('DATE(start_datetime) as date')
            ->selectRaw('SUM(total_amount) as total_amount')
            ->selectRaw('SUM(commission_amount) as commission_amount')
            ->selectRaw('SUM(total_amount - commission_amount) as profit_amount')
            ->when(isset($employeeID), function ($query) use ($employeeID) {
                return $query->where('employee_id', $employeeID);
            })
            ->groupBy('date')
            ->orderBy('date')
            ->get();

            return view('admin.dashboard', compact('caseStatusCounts', 'caseStatusCounts2', 'caseStatusCounts3', 'casesAmounts'));

        } else {
            return view('admin.dashboard');
        }
    }
}
