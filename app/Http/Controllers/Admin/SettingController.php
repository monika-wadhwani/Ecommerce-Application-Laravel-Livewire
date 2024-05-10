<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index(){
        $settings = SiteSetting::first();
        return view('admin.setting.index',compact('settings'));
    }

    public function save_setting(Request $request){
        $settings = SiteSetting::first();
        if($settings){
            $settings->update([
                'website_name'=> $request->website_name,
                'website_url'=> $request->website_url,
                'title'=> $request->title,
                'meta_keyword'=> $request->meta_keyword,
                'meta_description'=> $request->meta_description,
                'address'=> $request->address,
                'phone1'=> $request->phone1,
                'phone2'=> $request->phone2,
                'email1'=> $request->email1,
                'email2'=> $request->email2,
                'facebook'=> $request->facebook,
                'twitter'=> $request->twitter,
                'instagram'=> $request->instagram,
                'youtube'=> $request->youtube,
            ]);
            return redirect()->back()->with('message','Site Settings Updated Successfully');
        }else{
            SiteSetting::create([
                'website_name'=> $request->website_name,
                'website_url'=> $request->website_url,
                'title'=> $request->title,
                'meta_keyword'=> $request->meta_keyword,
                'meta_description'=> $request->meta_description,
                'address'=> $request->address,
                'phone1'=> $request->phone1,
                'phone2'=> $request->phone2,
                'email1'=> $request->email1,
                'email2'=> $request->email2,
                'facebook'=> $request->facebook,
                'twitter'=> $request->twitter,
                'instagram'=> $request->instagram,
                'youtube'=> $request->youtube,
            ]);
            return redirect()->back()->with('message','Site Settings Saved Successfully');
        }

       
    }
}
