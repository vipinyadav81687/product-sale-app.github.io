<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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
            $user->save();
              
             return back()->with('success', 'Your Registration has been Successfully!');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

}
