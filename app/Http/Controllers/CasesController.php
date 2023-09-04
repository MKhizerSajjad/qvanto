<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $cases = Cases::orderBy('start_datetime','DESC');
        
        if(Auth::user()->user_type == 3) {
            $cases = $cases->with('employee:id,first_name,last_name')->where('customer_id', Auth::user()->id);
        } else if(Auth::user()->user_type == 2) {
            $cases = $cases->with('customer:id,first_name,last_name')->where('employee_id', Auth::user()->id);
        } else {
            $cases = $cases->with('employee:id,first_name,last_name')->with('customer:id,first_name,last_name');
        }
        
        if ($request->has('case_type') && $request->case_type != '') {
            $case_type = $request->case_type;
            $cases = $cases->where('case_type', $case_type);
        }
        
        if ($request->has('case') && $request->case != '') {
            $case = $request->case;
            $cases = $cases->where('case', $case);
        }

        
        $data = $cases->paginate(100);

        return view('admin.case.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Appointment $appointment, Request $request)
    {
        $appointment = Appointment::where('id', $request->app)->first();
        $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name')->get();
        $customers = Customer::where('status', 1)->where('user_type', 3)->select('id', 'first_name', 'last_name')->get();
        if(Auth::user()->user_type == 3) {
            return redirect('case');
        // } else if(Auth::user()->user_type == 2) {
        } else {
            return view('admin.case.create', compact('appointment','employees', 'customers'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Appointment $appiontment)
    {

        $this->validate($request, [
            'comission_percentge' => 'required|integer|min:1|max:100',
            'total_amount' => 'required|integer|min:1'
        ]);

        // // Customer
        // if (Auth::user()->user_type != 3 && isset($request->customer)) {
        //     $customer = $request->customer;
        // } else if (Auth::user()->user_type == 3) {
        //     $customer = Auth::user()->id;
        // } else {
        //     $customer = Null;
        // }
        // // Employee
        // if (Auth::user()->user_type == 1 && isset($request->employee)) {
        //     $employee = $request->employee;
        // } else if (Auth::user()->user_type == 2) {
        //     $employee = Auth::user()->id;
        // } else {
        //     $employee = Null;
        // }

        // dd($request->datetime);

        $comissionAmount = ($request->comission_percentge * $request->total_amount) / 100;
        $data = [
            'status' => 1,
            'case_type_id' => $request->case_type,
            // 'case_id' => $request->case_id,
            'appointment_id' => $request->appointment_id,
            'customer_id' => $request->customer,
            'employee_id' => $request->employee,
            'total_amount' => $request->total_amount,
            'commission_amount' => $comissionAmount,
            'start_by' => Auth::user()->id,
            'start_datetime' => now(),
            'note' => $request->note
        ];

        $added = Cases::create($data);

        return redirect()->route('case.index')->with('success','Case started successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cases $cases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cases $case)
    {
        $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name')->get();
        $customers = Customer::where('status', 1)->where('user_type', 3)->select('id', 'first_name', 'last_name')->get();
        
        return view('admin.case.edit', compact('case', 'employees', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cases $case)
    {
        $comissionAmount = ($request->comission_percentge * $request->total_amount) / 100;

        $data = [
            'status' => $request->status,
            // 'case_type_id' => $request->case_type,
            // // 'case_id' => $request->case_id,
            // 'customer_id' => $request->customer,
            // 'employee_id' => $request->employee,
            'total_amount' => $request->total_amount,
            'commission_amount' => $comissionAmount,
            'note' => $request->note
        ];

        $updated = Cases::find($case->id)->update($data);

        return redirect()->route('case.index')->with('success','Case updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cases $cases)
    {
        //
    }
}
