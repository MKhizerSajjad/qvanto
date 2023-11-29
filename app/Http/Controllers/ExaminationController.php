<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Counselor;
use App\Models\Examination;
use App\Models\Employee;
use App\Models\Customer;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $examinations = Examination::orderBy('dated','DESC');

        if(Auth::user()->user_type == 4) {
            $examinations = $examinations->with(['employee:id,first_name,last_name', 'counselor:id,first_name,last_name'])->where('customer_id', Auth::user()->id);
        } elseif(Auth::user()->user_type == 3) {
            $examinations = $examinations->with(['employee:id,first_name,last_name', 'customer:id,first_name,last_name'])->where('counselor_id', Auth::user()->id);
        } elseif(Auth::user()->user_type == 2) {
            $examinations = $examinations->with(['customer:id,first_name,last_name', 'counselor:id,first_name,last_name'])->where('employee_id', Auth::user()->id);
        } else {
            $examinations = $examinations->with(['employee:id,first_name,last_name', 'customer:id,first_name,last_name', 'counselor:id,first_name,last_name']);
        }

        if ($request->has('date') && $request->date != '') {
            $date = $request->date;
            $examinations = $examinations->where('date', 'LIKE', $date.'%');
        }

        $data = $examinations->paginate(100);

        return view('admin.examination.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 1);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name')->get();
        $counselors = Counselor::where('status', 1)->where('user_type', 3)->select('id', 'first_name', 'last_name')->get();
        $customers = Customer::where('status', 1)->where('user_type', 4)->select('id', 'first_name', 'last_name')->get();

        return view('admin.examination.create', compact('employees', 'counselors', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->user_type == 4) {
            $this->validate($request, [
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'status' => 'required',
                'counselor' => 'required',
                'examinar' => 'required',
                'client' => 'required',
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        }

        // Customer
        if (Auth::user()->user_type != 4 && isset($request->client)) {
            $customer = $request->client;
        } elseif (Auth::user()->user_type == 4) {
            $customer = Auth::user()->id;
        } else {
            $customer = Null;
        }
        // Employee
        if (Auth::user()->user_type == 1 && isset($request->examinar)) {
            $employee = $request->examinar;
        } elseif (Auth::user()->user_type == 1 || Auth::user()->user_type == 2) {
            $employee = Auth::user()->id;
        } else {
            $employee = Null;
        }
        // Counselor
        if ((Auth::user()->user_type == 1 || Auth::user()->user_type == 2) && isset($request->counselor)) {
            $counselor = $request->counselor;
        } elseif (Auth::user()->user_type == 3) {
            $counselor = Auth::user()->id;
        } else {
            $counselor = Null;
        }

        $currentDate = now()->format('Ymd');
        // Retrieve the last saved challan number for today
        $lastExamId = Examination::whereDate('created_at', today())->latest('exam_id')->first();

        // Extract the incremental value and increment it
        $incrementalValue = $lastExamId ? intval(substr($lastExamId->challan_number, -3)) + 1 : 1;

        // Pad the incremental value with leading zeros
        $paddedIncrementalValue = str_pad($incrementalValue, 3, '0', STR_PAD_LEFT);

        // Concatenate the current date and the incremented value
        $examId = $currentDate . $paddedIncrementalValue;

        $data = [
            'exam_id' => $examId,
            'dated' => isset($request->datetime) ? $request->datetime : now(),
            'customer_id' => $customer,
            'employee_id' => $employee,
            'counselor_id' => $counselor,
            'case_type_id' => $request->case_type,
            'language' => $request->language,
            'other_language' => $request->other_language,
            'autism' => $request->autism,
            'intellectual_disability' => $request->intellectual_disability,
            'authorization' => $request->authorization,
            'disability' => $request->disability,
            'prior_diagnoses' => $request->prior_diagnoses,
            'medications' => $request->medications,
            'vocational_objective' => $request->vocational_objective,
            'payer' => isset($request->payer) ? $request->payer : 'Bureau of Vocational Rehabilitation',
            'emergency_name' => $request->emergency_name,
            'emergency_mobile_number' => $request->emergency_mobile_number,
            'family_relation' => $request->family_relation,
            'family_name' => $request->family_name,
            'family_mobile_number' => $request->family_mobile_number,
            'family_email' => $request->family_email,
            'note' => $request->note
        ];

        $added = Examination::create($data);

        return redirect()->route('examination.index')->with('success','Examination created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Examination $examination)
    {

        $employees = Employee::where('status', 1)->get();

        return view('admin.examination.edit', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Examination $examination)
    {
        $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name')->get();
        $counselors = Counselor::where('status', 1)->where('user_type', 3)->select('id', 'first_name', 'last_name')->get();
        $customers = Customer::where('status', 1)->where('user_type', 4)->select('id', 'first_name', 'last_name')->get();

        return view('admin.examination.edit', compact('examination', 'employees', 'counselors', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Examination $examination)
    {
        if(Auth::user()->user_type == 4) {
            $this->validate($request, [
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'status' => 'required',
                'counselor' => 'required',
                'examinar' => 'required',
                'client' => 'required',
                'case_type' => 'required',
                'datetime' => 'required',
            ]);
        }

        // Customer
        if (Auth::user()->user_type != 4 && isset($request->client)) {
            $customer = $request->client;
        } elseif (Auth::user()->user_type == 4) {
            $customer = Auth::user()->id;
        } else {
            $customer = Null;
        }
        // Employee
        if (Auth::user()->user_type == 1 && isset($request->examinar)) {
            $employee = $request->examinar;
        } elseif (Auth::user()->user_type == 1 || Auth::user()->user_type == 2) {
            $employee = Auth::user()->id;
        } else {
            $employee = Null;
        }
        // Counselor
        if ((Auth::user()->user_type == 1 || Auth::user()->user_type == 2) && isset($request->counselor)) {
            $counselor = $request->counselor;
        } elseif (Auth::user()->user_type == 3) {
            $counselor = Auth::user()->id;
        } else {
            $counselor = Null;
        }

        $data = [
            'status' => isset($request->status) ? $request->status : $examination->status,
            'is_accepted' => isset($request->accepted) ? $request->accepted : $examination->is_accepted,
            'dated' => isset($request->date) ? $request->date : now(),
            'customer_id' => $customer,
            'employee_id' => $employee,
            'counselor_id' => $counselor,
            'language' => $request->language,
            'other_language' => $request->other_language,
            'autism' => $request->autism,
            'intellectual_disability' => $request->intellectual_disability,
            'authorization' => $request->authorization,
            'disability' => $request->disability,
            'prior_diagnoses' => $request->prior_diagnoses,
            'medications' => $request->medications,
            'vocational_objective' => $request->vocational_objective,
            'payer' => isset($request->payer) ? $request->payer : 'Bureau of Vocational Rehabilitation',
            'emergency_name' => $request->emergency_name,
            'emergency_mobile_number' => $request->emergency_mobile_number,
            'family_relation' => $request->family_relation,
            'family_name' => $request->family_name,
            'family_mobile_number' => $request->family_mobile_number,
            'family_email' => $request->family_email,
            'note' => $request->note
        ];

        $updated = Examination::find($examination->id)->update($data);

        return redirect()->route('examination.index')->with('success','Examination updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Examination $examination)
    {
        $examination->delete();
        return redirect()->route('examination.index')->with('success','Examination deleted successfully');
    }
}
