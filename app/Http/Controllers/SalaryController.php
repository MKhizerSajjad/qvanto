<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Cases;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   

        $salaries = Salary::orderBy('year_month','DESC')->orderBy('dated','DESC');
        
        if(Auth::user()->user_type == 1) {
            $salaries = $salaries->with('employee:id,first_name,last_name');
        } else {
            $salaries = $salaries->with('employee:id,first_name,last_name')->where('employee_id', Auth::user()->id);
        }
        
        if ($request->has('dated') && $request->date != '') {
            $date = $request->date;
            $salaries = $salaries->where('dated', 'LIKE', $date.'%');
        }
        
        if ($request->has('month') && $request->date != '') {
            $month = $request->month;
            $salaries = $salaries->where('year_month', $month.'%');
        }
        
        $data = $salaries->paginate(100);

        return view('admin.salary.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 1);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if(Auth::user()->id) {
            $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name', 'basic_salary')->get();
            return view('admin.salary.create', compact('employees'));
        // } else {
        //     return redirect('admin.salary.index');
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'status' => 'required',
            // 'is_published' => 'required',
            'month' => 'required',
            'employee' => 'required',
            // 'basic_salary' => 'required|numeric',
            // 'comission' => 'required|numeric',
        ]);

        $data = [
            'status' => 4,
            'is_published' => $request->published,
            // 'month' => 1, //$request->month,
            'year_month' => $request->month, //date('Y-m-d'),
            'employee_id' => $request->employee,
            'total_amount' => $request->total_amount,
            'basic_salary' => $request->basic_salary,
            'case_comission' => $request->case_comission,
            'paid_amount' => 0,
            'note' => $request->note
        ];

        $added = Salary::create($data);

        return redirect()->route('salary.index')->with('success','Salary created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::where('status', 1)->whereIn('user_type', [1,2])->select('id', 'first_name', 'last_name')->get();

        return view('admin.salary.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $this->validate($request, [
            'status' => 'required',
            'is_published' => 'required',
            'month' => 'required',
        ]);
        
        $data = [
            'status' => $request->status,
            'is_published' => $request->is_published,
            'month' => $request->month,
            'note' => $request->note
        ];

        $updated = Salary::find($salary->id)->update($data);

        return redirect()->route('salary.index')->with('success','Salary updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salary.index')->with('success','Salary deleted successfully');
    }
    
    public function getSalaryDetail($employeeId)
    {
        $employee = Employee::with(['cases' => function ($query) {
            $query->selectRaw('employee_id, SUM(total_amount) as total_amount_sum, SUM(commission_amount) as commission_amount_sum')
                ->groupBy('employee_id');
        }])->findOrFail($employeeId);
        
        $employee = $employee->toArray();

        $sumTotalAmount = $employee['cases'][0]['total_amount_sum'] ?? 0;
        $sumCommissionAmount = $employee['cases'][0]['commission_amount_sum'] ?? 0;
        
        // Perform necessary calculations to determine basic_salary, commission, and total
        // For demonstration purposes, let's assume you have these values as attributes in the Employee model
        
        return response()->json([
            'basic_salary' => $employee['basic_salary'],
            'commission' => $sumCommissionAmount,
            'total_amount' => ($employee['basic_salary'] + $sumCommissionAmount),
        ]);
    }
}
