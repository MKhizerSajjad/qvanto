<?php

namespace App\Http\Controllers;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'case_id' => 'required',
        ]);

        Auth::user()->id;

            foreach ($request->questions as $question) {
                $data = [
                    'case_id' => $request->case_id,
                    'case_type_id' => $request->case_type,
                    'question_id' => $question->question,
                    'detail' => $question->detail,
                    'note' => $question->note
                ];
                
                $added = CaseDetail::create($data);
            }

        $added = Cases::create($data);

        return view('admin.case.index')->with('success','Case questions added successfully');
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
    public function edit(CaseDetail $caseDetails)
    {
        return view('admin.casedetail.edit', compact('caseDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CaseDetail $caseDetails)
    {
        $this->validate($request, [
            'case_id' => 'required',
        ]);

        Auth::user()->id;

        foreach ($request->questions as $question) {
            $caseDetailData = [
                'case_type_id' => $request->case_type,
                'question_id' => $question->question,
                'detail' => $question->detail,
                'note' => $question->note
            ];
        
            CaseDetail::updateOrCreate(
                ['question_id' => $question->question],
                $caseDetailData
            );
        }

        return view('admin.case.index')->with('success','Case questions updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseDetail $caseDetail)
    {
        //
    }
}
