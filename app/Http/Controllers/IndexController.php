<?php

namespace App\Http\Controllers;
use App\user;
use Illuminate\Http\Request;
require'function.php';//加载功能
class IndexController extends Controller
{
    public function search(Request $request)//搜索文章
    {
    	$choice =$request->input('kind');
    	$message = $request->input('message');
    	//echo ($message);
    	$articles = article_find($choice,$message);
    	//json_encode($articles);
    	return view('search',compact('articles'));
 	}
 	public function load()//返回首页加载数据
 	{
 		$id = session()->get('id');
 		$person = user::where('id',$id)->find($id);
 		//dd($person);
 		$data = ["code"=>1,"person"=>$person];
 		$data = json_encode($data);
 		//echo ($person);
 		$articles = article_find(1,1);
 		return view('index',compact('data','articles'));
 	}
 	
}
