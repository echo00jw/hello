<?php

namespace App\Http\Controllers;
use App\user;
use Illuminate\Http\Request;
require'function.php';//加载功能
class JsonController extends Controller
{
    public function search(Request $request)
    {
    	$choice =$request->input('kind');
    	$message = $request->input('message');
    	//echo ($message);
    	$articles = article_find($choice,$message);
    	//json_encode($articles);
    	return view('json_page',compact('articles'));
 	}
 	public function load()
 	{
 		$id = session()->get('id');
 		$persons = user::where('id',$id)->find($id);
 		//dd($persons);
 		json_encode($persons);
 		//echo ($persons);
 		$articles = article_find(1,1);
 		return view('json_index',compact('persons','articles'));
 	}
}
