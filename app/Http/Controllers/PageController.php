<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
require'function.php';//加载功能

class PageController extends Controller
{
    public function edit($articleId)
    {
    	$data = edit_load($articleId);
    	return view('page',compact('data'));
    }
}
