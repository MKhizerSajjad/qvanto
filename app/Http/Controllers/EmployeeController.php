<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Employee::orderBy('first_name', 'DESC')
        ->paginate(1);

        return view('admin.employee.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employee.create');
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
            'status' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();

        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/users');
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
        $user = Employee::create($data);

        return redirect()->route('employee.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::find($employee->id);

        return view('admin.employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $route = Route::current()->uri();
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
