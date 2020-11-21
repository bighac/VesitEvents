<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    //Main page view
    function mainPage(){
        return view('main-page');
    }


    //Society Page view
    function societyPage(){
        return view('society-page');
    }

    //Password Reset
    function passwordResetPage(){
        return view('reset_pass');
    }

    function passwordReset(Request $request){
        $email = $request->email;
        $user = User::where('email',$email)->first();
        if($user){
            Mail::to($user->email)->send(new MailController($user,'password_mail'));
            $status = "Email link has been send.";
            return redirect('/reset')->with('status',$status);
        }
    }

    function newPasswordPage(Request $request){
        $id = User::where('email',session('email'))->first('id');
        return view('new_password',compact(['id']));
    }

    function newPassword(Request $request,$id){
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        $status = "Password Reset Complete";
        return redirect('/login')->with('status');
    }
}