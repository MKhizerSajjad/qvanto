<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Customer;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $appiontments = Appointment::orderBy('dated','DESC');
        
        if(Auth::user()->user_type == 3) {
            $appiontments = $appiontments->with('employee:id,first_name,last_name')->where('customer_id', Auth::user()->id);
        } else if(Auth::user()->user_type == 2) {
            $appiontments = $appiontments->with('customer:id,first_name,last_name')->where('employee_id', Auth::user()->id);
        } else {
            $appiontments = $appiontments->with('employee:id,first_name,last_name')->with('customer:id,first_name,last_name');
        }
        
        if ($request->has('date') && $request->date != '') {
            $date = $request->date;
            $appiontments = $appiontments->where('date', 'LIKE', $date.'%');
        }

        
        $data = $appiontments->paginate(100);

        return view('admin.appointment.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 1);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name')->get();
        $customers = Customer::where('status', 1)->where('user_type', 3)->select('id', 'first_name', 'last_name')->get();

        return view('admin.appointment.create', compact('employees', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->user_type == 3) {
            $this->validate($request, [
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'status' => 'required',
                'customer' => 'required',
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        }

        // Customer
        if (Auth::user()->user_type != 3 && isset($request->customer)) {
            $customer = $request->customer;
        } else if (Auth::user()->user_type == 3) {
            $customer = Auth::user()->id;
        } else {
            $customer = Null;
        }
        // Employee
        if (Auth::user()->user_type == 1 && isset($request->employee)) {
            $employee = $request->employee;
        } else if (Auth::user()->user_type == 2) {
            $employee = Auth::user()->id;
        } else {
            $employee = Null;
        }

        // dd($request->datetime);
        $data = [
            'dated' => isset($request->datetime) ? $request->datetime : now(),
            'customer_id' => $customer,
            'employee_id' => $employee,
            'case_type_id' => $request->case_type,
            'note' => $request->note
        ];

        $added = Appointment::create($data);

        return redirect()->route('appointment.index')->with('success','Appointment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {

        $employees = Employee::where('status', 1)->get();

        return view('admin.appointment.edit', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name')->get();
        $customers = Customer::where('status', 1)->where('user_type', 3)->select('id', 'first_name', 'last_name')->get();

        return view('admin.appointment.edit', compact('appointment', 'employees', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        if(Auth::user()->user_type == 3) {
            $this->validate($request, [
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'status' => 'required',
                'customer' => 'required',
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        }

        // Customer
        if (Auth::user()->user_type != 3 && isset($request->customer)) {
            $customer = $request->customer;
        } else if (Auth::user()->user_type == 3) {
            $customer = Auth::user()->id;
        } else {
            $customer = Null;
        }
        // Employee
        if (Auth::user()->user_type == 1 && isset($request->employee)) {
            $employee = $request->employee;
        } else if (Auth::user()->user_type == 2) {
            $employee = Auth::user()->id;
        } else {
            $employee = Null;
        }

        $data = [
            'status' => isset($request->status) ? $request->status : $appointment->status,
            'is_accepted' => isset($request->accepted) ? $request->accepted : $appointment->is_accepted,
            'dated' => isset($request->date) ? $request->date : now(),
            'customer_id' => $customer,
            'employee_id' => $employee,
            'note' => $request->note
        ];

        $updated = Appointment::find($appointment->id)->update($data);

        return redirect()->route('appointment.index')->with('success','Appointment updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointment.index')->with('success','Appointment deleted successfully');
    }
}
