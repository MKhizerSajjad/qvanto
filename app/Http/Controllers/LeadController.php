<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Vendor;
use App\Models\LeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::orderBy('dated','DESC');

        if(Auth::user()->user_type == 1) {
            $leads = $leads->with(['vendor:id,first_name,last_name']);
        } else {
            $leads = $leads->where('vendor_id', Auth::user()->id);
        }

        if ($request->has('date') && $request->date != '') {
            $date = $request->date;
            $leads = $leads->where('date', 'LIKE', $date.'%');
        }

        $data = $leads->get();

        return view('admin.lead.index',compact('data'));
    }

    public function create()
    {
        $vendors = Vendor::where('status', 1)->whereIn('user_type', [2])->select('id', 'first_name', 'last_name')->get();

        return view('admin.lead.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'vendor' => 'required',
            'lead_type' => 'required',
            'date' => 'required',
            'status' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255',
            'mobile_number' => 'min:10|max:18|unique:users',
        ]);

        $data = [
            'vendor_id' => $request->vendor,
            'lead_type' => $request->lead_type,
            'dated' => $request->date,
            'status' => $request->status ?? 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'note' => $request->note
        ];
        $lead = Lead::create($data);

        $data = [
            'lead_id' => $lead->id,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'dated' => now()->format('Y-m-d'),
            'note' => $request->note ?? 'just created'
        ];
        LeadStatus::create($data);

        return redirect()->route('lead.index')->with('success','Record created successfully');
    }

    public function show(Lead $lead)
    {
        $lead = Lead::where('status', 1)->get();
        return view('admin.lead.edit', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        $vendors = Vendor::where('status', 1)->whereIn('user_type', [2])->select('id', 'first_name', 'last_name')->get();
        return view('admin.lead.edit', compact('vendors', 'lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $this->validate($request, [
            'vendor' => 'required',
            'lead_type' => 'required',
            'date' => 'required',
            'status' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255',
            'mobile_number' => 'min:10|max:18|unique:users',
        ]);

        $data = [
            'vendor_id' => $request->vendor,
            'lead_type' => $request->lead_type,
            'dated' => $request->date,
            'status' => $request->status ?? 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'note' => $request->note
        ];
        Lead::find($lead->id)->update($data);

        if($lead->status != $request->status) {
            $data = [
                'lead_id' => $lead->id,
                'user_id' => Auth::user()->id,
                'status' => $request->status,
                'dated' => now()->format('Y-m-d'),
                'note' => 'lead updated'
            ];
            LeadStatus::create($data);
        }
        return redirect()->route('lead.index')->with('success','Record updated successfully');
    }

    public function comment(Lead $lead)
    {
        return view('admin.lead.comment', compact('lead'));
    }

    public function commentUpdate(Request $request, Lead $lead)
    {
        $this->validate($request, [
            'status' => 'required',
            'note' => 'required'
        ]);

        $data = [
            'lead_id' => $lead->id,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'dated' => now()->format('Y-m-d'),
            'note' => $request->note
        ];
        LeadStatus::create($data);

        $data = [
            'status' => $request->status ?? 1,
            'note' => $request->note
        ];
        Lead::find($lead->id)->update($data);

        return redirect()->route('lead.index')->with('success','Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
