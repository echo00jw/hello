<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require'function.php';//加载功能
class AjaxController extends Controller
{
    public function change(Request $request)
    {
    	$score = $request->input('score');
    	$articleId = $request->input('articleId');
    	//$request  = json_decode($request);
    	//以后$request为json
    	$result = data_change($score,$articleId);//修改对应的数据（收藏和评分）
    	$code = ["input"=>$request,"result"=>$result];
    	$code = json_encode($code);
    	return view('Page',compact('code'));
    }
}
