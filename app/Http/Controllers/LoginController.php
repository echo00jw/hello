<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\login;
use App\article;
require'function.php';//加载功能
session_start();
$_SESSION['temp'] = 1;
date_default_timezone_set('Asia/Shanghai');//设置时区
class LoginController extends Controller
{
    public function Login(Request $request)//登陆时初始化
    {
	    $this->validate($request, ['captcha' => 'required|captcha']);//验证验证码
	    $temp = user::where('id',$request->input('id'))->findOrFail($request->input('id'));//验证账号  findOrFail 没有找到时返回0
	    if($temp!=NULL)
	    {
		    if($temp->password == md5($request->password))//核对密码
		    {
			    person($temp,$request);//储存登陆信息
			    $articles = article_find(1,1);//获取热门文章
			    sessions($temp);//调用session
			    $data = ["code"=>1,"input"=>$request->input(),"person"=>$temp];
				$data = json_encode($data);//转化为json格式
				return view('index',compact('data','articles'));//跳转首页
			}
			$_SESSION['temp']=2;//密码错误的条件
		}
		judge($temp);//判断并返回账号或者密码提示		
	}
	
	
}
