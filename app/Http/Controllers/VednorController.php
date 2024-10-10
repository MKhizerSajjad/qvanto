<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VednorController extends Controller
{
    public function index(Request $request)
    {
        $users = Vendor::where('id', '!=', Auth::user()->id)->where('user_type', 2)->orderBy('first_name','DESC');

        if ($request->has('first_name') && $request->first_name != '') {
            $first_name = $request->first_name;
            $users = $users->where('first_name', 'LIKE', $first_name.'%');
        }

        if ($request->has('last_name') && $request->last_name != '') {
            $last_name = $request->last_name;
            $users = $users->where('last_name', 'LIKE', $last_name.'%');
        }

        if ($request->has('email') && $request->email != '') {
            $email = $request->email;
            $users = $users->where('email', 'LIKE', $email.'%');
        }

        if ($request->has('mobile_number') && $request->mobile_number != '') {
            $mobile_number = $request->mobile_number;
            $users = $users->where('mobile_number', 'LIKE', $mobile_number.'%');
        }

        if ($request->has('status') && $request->status != '') {
            $status = $request->status;
            $users = $users->where('status', $status);
        }

        if ($request->has('address') && $request->address != '') {
            $address = $request->address;
            $users = $users->where('address', 'LIKE', '%'.$address.'%');
        }

        if ($request->has('zipcode') && $request->zipcode != '') {
            $zipcode = $request->zipcode;
            $users = $users->where('zipcode', 'LIKE', '%'.$zipcode.'%');
        }

        $data = $users->get();

        return view('admin.vendor.index',compact('data'));
        // ->with('i', ($request->input('page', 1) - 1) * 1
    }

    public function stats(Request $request)
    {
        $statusMappings = getLeadStatus(null, null);
        $caseStatements = [];
        foreach ($statusMappings as $status => $label) {
            $caseStatements[] = "SUM(CASE WHEN leads.status = {$status} THEN 1 ELSE 0 END) as `{$label}`";
        }
        $caseSql = implode(", ", $caseStatements);

        $data = Vendor::with(['leads' => function($q) use ($caseSql) {
            $q->select('vendor_id', DB::raw("
                COUNT(*) as total,
                {$caseSql}
            "))
            ->groupBy('vendor_id');
        }])
        ->where('id', '!=', Auth::user()->id)
        ->where('user_type', 2)->get();

        return view('admin.vendor.stats', compact('data'));
    }

    public function create()
    {
        return view('admin.vendor.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users',
            'mobile_number' => 'min:11|max:18|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();

        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/vendors');
            if (!file_exists($imageStorage)) {
                mkdir($imageStorage, 0755, true);
            }
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            $picture = $request->picture;
            $extension = $picture->getClientOriginalExtension();

            if(in_array($extension, $imageExt)) {
                $sluggedName = Str::slug($request->first_name).'-'.Str::slug($request->last_name);
                $data['picture'] = $image = $sluggedName.'.'.$extension;
                $picture->move($imageStorage, $image); // Move File
            }
        }

        $data['password'] = Hash::make($data['password']);
        unset($data['password_confirmation']);
        $data['user_type'] = 2;
        $data['status'] = 1;
        $user = Vendor::create($data);

        return redirect()->route('vendor.index')->with('success','Vendor created successfully');
    }

    public function show(Vendor $vendor)
    {
        $data = [
            'vendor' => $vendor,
        ];
        return view('admin.vendor.show', compact($data));
    }

    public function edit(Vendor $vendor)
    {
        $vendor = Vendor::find($vendor->id);
        return view('admin.vendor.edit',compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $this->validate($request, [
            'status' => 'required',
            'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users,email,'.$vendor->id,
            'mobile_number' => 'min:11|max:18|unique:users,mobile_number,'.$vendor->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->all();

        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/vendors');
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            $picture = $request->picture;
            $extension = $picture->getClientOriginalExtension();

            if(in_array($extension, $imageExt)) {
                $sluggedName = Str::slug($request->first_name).'-'.Str::slug($request->last_name);
                $data['picture'] = $image = $sluggedName.'.'.$extension;
                $picture->move($imageStorage, $image); // Move File
            }
        }

        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
            unset($data['password_confirmation']);
        }else{
            $data = Arr::except($data,array('password'));
            $data = Arr::except($data,array('password_confirmation'));
        }

        $user = Vendor::find($vendor->id);
        $user->update($data);

        return redirect()->route('vendor.index')->with('success','Vendor updated successfully');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')->with('success','Vendor deleted successfully');
    }
}
