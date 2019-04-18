<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\extend\send\send;
class RegisterController extends Controller
{
    public function register()
    {

        return view('login.register');
    }

    public function add(Request $request)
    {
        $arr = $request->input();
        // var_dump($arr);exit;
        $tel = $arr['tel'];
        $pwd = $arr['pwd'];
        $conpwd = $arr['conpwd'];
        $code=$arr['code'];
        $time=time();
        $sql="select * from code where name=$tel and code=$code and timeout>$time  and status=1";

//  return ($sql);exit;
        $user=DB::select($sql);
       // return($user);exit;
       // var_dump($user);exit;
        if(empty($user)) {
            $arr = array(
                'status' => 0,
                'msg' => '验证码错误',
            );
            return $arr;
        }
        $arr = DB::table("user")->where("name", $tel)->first();
        //  var_dump($arr);
        if (!empty($arr)) {
            $arr = array(
                'status' => 0,
                'msg' => '手机号已经注册',

            );

            return $arr;

        }
        //判断密码是否一致
        if ($pwd != $conpwd) {
            $arr = array(
                'status' => 0,
                'msg' => '密码不一致',
            );
            return $arr;
        }
        //验证唯一性


        $info=[
            'name'=>$tel,
            'pwd'=>md5($pwd),

        ];


        $arr=DB::table("user")->insert($info);
       // var_dump($arr);exit;
        if($arr){
            $arr=array(
                'status'=>1,
                'msg'=>'注册成功',
            );
            return $arr;
        }else{
            $arr=array(
                'status'=>0,
                'msg'=>'注册失败',
            );
            return $arr;
        }
    }
    public function code(Request $request){

        $tel=$request->input('tel');
        $arr = DB::table("user")->where("name", $tel)->first();
        //  var_dump($arr);
        if (!empty($arr)) {
            $arr = array(
                'status' => 0,
                'msg' => '手机号已经注册',

            );

            return $arr;exit;

        }else{
            $num = rand(1000,9999);
            $time=time();
            // var_dump($tel);exit;
            $obj=new send();
            $res=$obj->show($tel,$num);
            //var_dump($res);
            if($res==100){
                $arr=array(
                    'name'=>$tel,
                    'code'=>$num,
                    'timeout'=>$time+60,
                    'status'=>1,
                );
                //  var_dump($arr);
                $res=DB::table('code')->insert($arr);
                //var_dump($res);exit;

            }

        }




       //var_dump($res);exit;
    }

}
//echo time();
