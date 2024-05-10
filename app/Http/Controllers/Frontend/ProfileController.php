<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        return view('frontend.users.profile');
    }

    public function updateProfile(Request $request){

        $request->validate([
            'name' =>['required','string'],
            'phone' => ['required','digits:10'],
            'pincode' => ['required','digits:6'],
            'address' => ['required','string','max:500'],
        ]);
      $user = User::findOrFail(Auth::user()->id);
      $user->update([
        'name' => $request->name,
        'email' => $request->email,
      ]);
      
      $user->profile()->updateOrCreate(
        [
        'user_id'=> $user->id,
        ],
        [
        'phone'=> $request->phone,
        'pincode'=>$request->pincode,
        'address'=>$request->address,
        ]
    );
    return redirect()->back()->with('message', 'User Updated Successfully.');
    }

    public function change_password(){
        return view('frontend.users.change_password');
    }

    public function confirmed_password(Request $request){
        $request->validate([
            'current_password'=> ['required','min:8','string'],
            'new_password' => ['required','min:8','string','confirmed'],
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, Auth::user()->password);

        if($currentPasswordStatus){
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->back()->with('message','Password Changed Successfully.');
        }
        else{
            return redirect()->back()->with('message','Current Password Does Not Match with Old Password.');

        }
    }
}
