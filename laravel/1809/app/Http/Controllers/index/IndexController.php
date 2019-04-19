<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function index(){
        $sql=DB::table('shop_goods')->where('goods_hot',1)->take(2)->get();
        //var_dump($sql);exit;

        //var_dump($page);
        return view('index.index',['sql'=>$sql]);
    }


    public function loading(Request $request){
        $arr=array();
        $page=$request->input('page',1);
         $pageNum=2;
        $offset=($page-1)*$pageNum;
       // var_dump($res);exit;
        $arrDataInfo=DB::table("shop_goods")->offset($offset)->limit($pageNum)->get();//每页的数据
        $totalData=DB::table("shop_goods")->count();//总条数
        $pageTotal=ceil($totalData/$pageNum);//总页数
        $objview=view("index.show",['info'=>$arrDataInfo]);
        $countent=response($objview)->getContent();
        $arr['info']=$countent;
        $arr['page']=$pageTotal;
       return $arr;
    }
    public function user(){
        return view('index.user');
    }
}
