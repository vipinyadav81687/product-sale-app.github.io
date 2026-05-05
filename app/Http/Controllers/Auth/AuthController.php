<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
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

    public function forgetPasswordView()
    {
        try{
            return view('auth.forget-password');

        }
        catch(\Exception $e){
            return abort(404,"something went wrong!");
        }
    }

    public function forgetPassword(Request $request)
    {
     try{
      $user = User::where('email',$request->email)->first();

        if(!$user){
            return back()->with('error','Email is not Exists!');
        }


      $token = Str::random(40);
      $url = url('/reset-password/'.$token);


      PasswordReset::updateOrInsert(
      [
       'email'=> $user->email
      ],
      [
        'email' => $user->email,
        'token' => $token,
        'created_at' => Carbon::now()
      ]
    );

      Mail::send('mails.forget-password',['url' => $url], function($message) use($user){
        $message->to($user->email)->subject('Reset Password');
      });
        
       return back()->with('success','Please check your mail and Password! ');

     }catch(\Exception $e){
        return back()->with('error', $e->getMessage());
     }

    }


    public function resetPasswordView($token)
    {
        try{
        $resetData = PasswordReset::where('token', $token)->first();
           if(!$resetData){
            return abort(404, "Something went wrong!");
           }

         $user =   User::where('email', $resetData->email)->first();
            return view('auth.reset-password', compact('user'));

        }
        catch(\Exception $e){
            return abort(404,"something went wrong!");
        }
    }



    public function resetPassword(ResetPasswordRequest $request)
    {
        try{
           $user = User::find($request->id);
           $user->password = Hash::make($request->password);
           $user->save();
          
           PasswordReset::where('email',$user->email)->delete();
           return redirect()->route('passwordUpdated');

        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function passwordUpdated()
    {
        try{
            return view('auth.password-Updated');
        }catch(\Exception $e){
            return abort(404, "Something Went Wrong!");
        }
    }
}
