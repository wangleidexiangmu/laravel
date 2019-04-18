<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }
    public function log(Request $request){
         $arr=$request->input();
       // var_dump($arr);exit;
        $tel=$arr['tel'];
        $pwd=$arr['pwd'];
        $pwd=md5($pwd);
        $where=['name'=>$tel,'pwd'=>$pwd];
        $res=DB::table("user")->where($where)->first();
//        return $res;exit;
       // var_dump($res);exit;
        if($res){
            $arr['user_id']=$res->user_id;
            $arr['name']=$res->name;
            session($arr);
            return array('status'=>1,"msg"=>"登录成功");
        }else{
            return array('status'=>0,"msg"=>"登录失败");
        }
    }
}
