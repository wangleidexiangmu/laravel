<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegauthController extends Controller
{
    public function regauth(){
        return view('login.regauth');
    }
}
