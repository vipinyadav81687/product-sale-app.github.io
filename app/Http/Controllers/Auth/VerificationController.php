<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
    //

public function verify($token)
{
    $user = User::where('verification_token',$token)->first();
    if ($user->token_expires_at < Carbon::now()) {
    $msg = 'Verification token has expired. Please request a new Verification email.';
    return view('auth.verification-message', compact('msg'));
}

$user->is_verified = 1;
$user->email_verified_at = Carbon::now();
$user->verification_token = null;
$user->token_expires_at = null;
$user->save();

$msg = 'Email Verified Successfully!';
return view('auth.verification-message', compact('msg'));
}
$user->is 


}
