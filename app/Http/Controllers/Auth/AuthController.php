<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function registerView()
    {
        try{
            return view('auth.register');

        }
        catch(\Exception $e){
            return abort(404,"something went wrong!");
        }
    }


    public function register(RegisterRequest $request)
    {
        try{
            $user = new User;
            $user->name = $request->name;
            $user->email =  $request->email;
            $user->country_code = $request->code;
            $user->phone_number = $request->phone;
            $user->password = Hash::make($request->password);
            $user->verification_token = Str::random(60);
            $user->token_expires_at  = Carbon::now()->addHour();
            $user->save();
              
            $this->sendVerificationMail($user);
             return back()->with('success', 'Your Registration has been Successfully, Please check your mail to verify your account!');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    protected function sendVerificationMail($user)
    {
       $verificationUrl =url('/verify/'.$user->verification_token);
       Mail::send('mails.verification', ['name' => $user->name, 'url' => $verificationUrl], function ($message) use ($user) {
       $message->to($user->email);
       $message->subject('Email Verification');
      });
   
   
       }

      public function loginView()
    {
        try{
            return view('auth.login');

        }
        catch(\Exception $e){
            return abort(404,"something went wrong!");
        }
    }

     public function login(LoginRequest $request)
    {
        try{

        $userCredentials = $request->only('email', 'password');

        if (Auth::attempt($userCredentials)) {

            if (Auth::user()->is_verified == 0) {
                Auth::logout();
                return back()->with('error', 'Please Verify your account!');
            }

            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }

        } else {
            return back()->with('error', 'Username & Password is incorrect!');
        } 
           
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

}
