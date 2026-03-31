<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerView()
    {
        try{

        }
        catch(\Exception $e){
            return abort(404,"something went wrong!");
        }
    }
}
