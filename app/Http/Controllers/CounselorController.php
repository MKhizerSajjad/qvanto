<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use App\Models\Counselor;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CounselorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = Counselor::where('id', '!=', Auth::user()->id)->where('user_type', 3)->orderBy('first_name','DESC');

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

        $data = $users->paginate(100);

        return view('admin.counselor.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 1);
    }

    public function create()
    {
        return view('admin.counselor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users',
            'mobile_number' => 'min:12|max:18|unique:users',
            'nic' => 'unique:users',
            'status' => 'required',
            // 'password' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();

        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/counselor');
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            $picture = $request->picture;
            $extension = $picture->getClientOriginalExtension();

            if(in_array($extension, $imageExt)) {
                $sluggedName = Str::slug($request->first_name).'-'.Str::slug($request->last_name);
                $data['picture'] = $image = $sluggedName.'.'.$extension;
                $picture->move($imageStorage, $image); // Move File
            }
        }

        // $data['password'] = Hash::make($data['password']);
        $data['password'] = Hash::make('default');
        unset($data['password_confirmation']);
        $data['user_type'] = 3;
        $data['status'] = 1;
        $user = Counselor::create($data);

        return redirect()->route('counselor.index')->with('success','Counselor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Counselor $counselor)
    {
        $data = [
            'counselor' => $counselor,
        ];
        return view('admin.counselor.show', compact($data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Counselor $counselor)
    {
        $counselor = Counselor::find($counselor->id);
        return view('admin.counselor.edit',compact('counselor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Counselor $counselor)
    {
        $this->validate($request, [
            'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users,email,'.$counselor->id,
            'mobile_number' => 'min:12|max:18|unique:users,mobile_number,'.$counselor->id,
            'nic' => 'unique:users,nic,'.$counselor->id,
            'status' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->all();

        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/counselor');
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

        $user = Counselor::find($counselor->id);
        $user->update($data);

        return redirect()->route('counselor.index')->with('success','Counselor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Counselor $counselor)
    {
        $counselor->delete();
        return redirect()->route('counselor.index')->with('success','Counselor deleted successfully');
    }
}
