<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $users)
    {
        if ($request->ajax()) {
            $users = $users->where('role', 'customer')->orderBy('id', 'DESC');
            return Datatables::eloquent($users)
            ->editColumn('first_name', function ($user) {
                return $user->first_name . ' ' . $user->last_name;
            })
                ->editColumn('phone', function ($user) {
                    return $user->phone;
                })
                ->editColumn('email', function ($user) {
                    return $user->email;
                })
                ->editColumn('status', function ($user) {
                    return $user->status;
                })
                ->addColumn('action', function (User $user) {

                    $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="' . route('admin.users.edit', $user->id) . '" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="' . route('admin.users.destroy', $user->id) . '" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;
                })
                ->toJson();
        } else {
            return view()->make('admin.users.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.users.add', compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];

        $messages = [
            'first_name.required' => 'Please enter your first name.',
            'first_name.string' => 'First name should only contain letters.',
            'first_name.max' => 'First name should not exceed 255 characters.',
            'last_name.required' => 'Please enter your last name.',
            'last_name.string' => 'Last name should only contain letters.',
            'last_name.max' => 'Last name should not exceed 255 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'email.max' => 'Email should not exceed 255 characters.',
            'phone.required' => 'Please enter your phone number.',
            'phone.numeric' => 'Phone number should only contain digits.',
            'phone.digits' => 'Phone number should be exactly 10 digits.',
            'phone.unique' => 'This phone number is already taken.',
            'password.required' => 'Please enter a password.',
            'password.string' => 'Password should be a string.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and confirmation do not match.',
            'password_confirmation.required' => 'Please confirm your password.',
            'password_confirmation.string' => 'Password confirmation should be a string.',
            'password_confirmation.min' => 'Password confirmation must be at least 8 characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }

        try {
            $user = new User;
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');
            $user->email_verified_at = now();
            $user->password = Hash::make($request->get('password'));
            $user->save();

            return response()->json(['success' => 'User created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong, please try again later.'], 422);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view()->make('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view()->make('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|max:255',
            'phone' => 'nullable|numeric|digits:10|unique:users,phone,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
        ];

        $messages = [
            'first_name.required' => 'Please enter your first name.',
            'first_name.string' => 'First name should only contain letters.',
            'first_name.max' => 'First name should not exceed 255 characters.',
            'last_name.required' => 'Please enter your last name.',
            'last_name.string' => 'Last name should only contain letters.',
            'last_name.max' => 'Last name should not exceed 255 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'email.max' => 'Email should not exceed 255 characters.',
            'phone.numeric' => 'Phone number should only contain digits.',
            'phone.digits' => 'Phone number should be exactly 10 digits.',
            'phone.unique' => 'This phone number is already taken.',
            'password.string' => 'Password should be a string.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and confirmation do not match.',
            'password_confirmation.string' => 'Password confirmation should be a string.',
            'password_confirmation.min' => 'Password confirmation must be at least 8 characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }

        try {
            $user = User::findOrFail($id);
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');

            if ($request->has('password') && !empty($request->password)) {
                $user->password = Hash::make($request->get('password'));
            }

            $user->save();

            return response()->json(['success' => 'User updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong, please try again later.'], 422);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json(['success', 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
