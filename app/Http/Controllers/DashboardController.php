<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Cases;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->user_type == 1) {

            $totalCases = Cases::count();
            $resolvedCases = Cases::where('status', 9)->count();

            // // Get the current year
            // $currentYear = Carbon::now()->year;

            // $usersCountByMonth = User::where('id', '!=', Auth::user()->id)
            //     ->where('user_type', 2)
            //     ->whereYear('registration_date', $currentYear)
            //     ->selectRaw('MONTH(registration_date) as month, COUNT(*) as count')
            //     ->groupBy('month')
            //     ->get();

            //     $registerUsers = [];
            //     for ($month = 1; $month <= 12; $month++) {
            //         $found = false;
            //         foreach ($usersCountByMonth as $item) {
            //             if ($item->month == $month) {
            //                 $registerUsers[] = $item->count;
            //                 $found = true;
            //                 break;
            //             }
            //         }
            //         if (!$found) {
            //             $registerUsers[] = 0;
            //         }
                // }

            return view('admin.dashboard', compact('totalCases', 'resolvedCases'));

        } else {
            return view('admin.dashboard');
        }
    }
}
