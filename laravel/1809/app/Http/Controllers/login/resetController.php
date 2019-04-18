<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class resetController extends Controller
{
    public function reset(){
        return view('login.reset');
    }
}
