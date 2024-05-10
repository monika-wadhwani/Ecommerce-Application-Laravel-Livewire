<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users= User::paginate(10);
        return view('admin.users.index',compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'role_as' => ['integer','required']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);

        return redirect('admin/users')->with('message','User Created Successfully.');
    }

    public function edit($user_id){
        $user = User::findOrFail($user_id);
        return view('admin.users.edit',compact('user'));
    }

    public function update($user_id, Request $request){
        $user = User::findOrFail($user_id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'min:8'],
            'role_as' => ['integer','required']
        ]);

        if($user){
            $user->update([
                'name' => $request->name,
                // 'email' => $request->email ?? $user->email,
                'password' => Hash::make($request->password) ?? $user->password,
                'role_as' => $request->role_as,
            ]);
            return redirect('admin/users')->with('message','User Updated Successfully.');
        }else{
            return redirect('admin/users')->with('message','User Not Found');
        }

    }

    public function delete($user_id){
        User::findOrFail($user_id)->delete();
        return redirect('admin/users')->with('message','User Deleted Successfully.');

    }
}
