<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\CaseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $case = Cases::where('id', $request->case)->first();
        $caseDetails = CaseDetail::where('case_id', $request->case)->orderBy('question_id')->get();
        // $caseDetails = count($caseDetails > 0)
        // return view('admin.case-detail.edit', compact('caseDetails'));
        return view('admin.case-detail.create', compact('case', 'caseDetails'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'case_id' => 'required',
        // ]);

        // foreach ($request->question_id as $key => $question) {
        //     $data = [
        //         'case_id' => $request->case_id,
        //         'case_type_id' => $request->case_type,
        //         'question_id' => $question,
        //         'detail' => $request->detail[$key],
        //         'note' => isset($request->note[$key]) ? $request->note[$key] : "" //
        //     ];
        //     $added = CaseDetail::create($data);
        // }
        $this->validate($request, [
            'case_id' => 'required',
        ]);

        foreach ($request->question_id as $key => $question) {
            $data = [
                'case_id' => $request->case_id,
                'case_type_id' => $request->case_type,
                'question_id' => $question,
                'detail' => $request->detail[$key],
                'note' => isset($request->note[$key]) ? $request->note[$key] : ""
            ];
            
            CaseDetail::updateOrCreate(
                ['case_id' => $request->case_id, 'case_type_id' => $request->case_type, 'question_id' => $question],
                $data
            );
            // $added = CaseDetail::create($data);
        }
        return redirect('case')->with('success','Case questions added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CaseDetail $caseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseDetail $caseDetail)
    {
        $caseDetails = CaseDetail::where('case_id', $caseDetail->case_id)->orderBy('question_id')->get();
        return view('admin.case-detail.edit', compact('caseDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CaseDetail $caseDetails)
    {
        $this->validate($request, [
            'case_id' => 'required',
        ]);

        foreach ($request->question_id as $key => $question) {
            $data = [
                'case_id' => $request->case_id,
                'case_type_id' => $request->case_type,
                'question_id' => $question,
                'detail' => $request->detail[$key],
                'note' => isset($request->note[$key]) ? $request->note[$key] : ""
            ];
            
            CaseDetail::updateOrCreate(
                ['case_id' => $request->case_id, 'case_type_id' => $request->case_type, 'question_id' => $question],
                $data
            );
            // $added = CaseDetail::create($data);
        }

        return redirect('case')->with('success','Case questions updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseDetail $caseDetail)
    {
        //
    }
}
