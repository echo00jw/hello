<?php
	use App\user;
	use App\login;
	use App\article;
/*--------------登陆功能库库------------*/


	function ip()//获取ip
	{
  		$onlineip=''; 
	 	if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){ 
	    	$onlineip=getenv('HTTP_CLIENT_IP'); 
	 	} 
		elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){ 
	  	   $onlineip=getenv('HTTP_X_FORWARDED_FOR'); 
	  	}
		elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){ 
	  	   $onlineip=getenv('REMOTE_ADDR'); 
	     } 
	 	elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){ 
	    	$onlineip=$_SERVER['REMOTE_ADDR']; 
	    }
		return $onlineip;
    }


    function sessions( $person)//生成session
    {
    	$_SESSION['temp'] = 3;
		session()->put('id', $person->id);
		session()->put('sex', $person->sex);
		session()->put('name', $person->name);
		session()->put('image', $person->image);
		session()->put('description', $person->description);
		session()->put('mycollection', $person->mycollection);
		session()->put('myhistory', $person->myhistory);
		session()->put('password', md5($person->password));
		session()->put('question', $person->question);
		session()->put('answer', $person->answer);
		session()->put('rule', $person->rule);
		session()->put('code', $person->code);
		session()->put('grade', $person->grade);    	
    }


    function judge($temp)//错误信息判断
    {
    	if($_SESSION['temp']==2){//密码判断		
			echo "<script type='text/javascript'>alert('密码错误');history.back();</script>";
			$_SESSION['temp'] = 3;
		}
		if($temp==NULL){//账号判断		
			echo "<script type='text/javascript'>alert('账号错误');history.back();</script>";
		}
    }


    function person($person,$request)//储存登陆信息
    {
    	$model = new login;
		$model->id = $request->input('id');
		$model->password = md5($request->password);
		$model->ip = ip();//获取ip
		$model->loginTime = date('Y-m-d H:i:s') ;
		$model->save();
    }

    function article_find($choice,$messages)//获取文章
    {
    	if($choice==1){//获取热门文章
	    	//$time = date('Y-m-d H:i:s',strtotime('-15 day'));//热门时间限制
	    	//$articles = article::where('createTime', '>', $time)->orderBy('look', 'desc')->paginate(5);
	    	$articles = article::orderBy('look', 'desc')->paginate(2);
	    	return $articles;
	    }
	    elseif($choice==2) {//通过标题查找文章
	    	$articles = article::where('title', 'like' , '%'.$messages.'%')->paginate(2);//没有找到默认值为0
	    	return $articles;	    	
	    }
	    elseif($choice==3) {//通过热词查找文章
	    	$articles = article::where('keyWord', 'like' , '%'.$messages.'%')->paginate(5);	
	    	return $articles;
	    }
	    elseif($choice==4) {//通过内容查找
	    	$articles = article::where('text', 'like' , '%'.$messages.'%')->paginate(5);
	    	return $articles;
	    }
	    elseif($choice==5) {
	    	$articles = article::where('articleId',$messages)->get();
	    	return $articles;
	    }
    }

/*---------------page函数库------------*/

	function edit_load($articleId)
	{
		//echo $articleId;
		$temp = session()->get('id');
    	$articles = article::where('articleId',$articleId)->first();//得到文章信息
    	//更新浏览历史
    	$model = new user;
        $themodel = $model->find($temp);
        $history = json_decode($themodel['myhistory']);
        foreach ($history as $key => $value) {
        	if(strcmp($value,$articleId)!=0){
        		$code =1;
        	}else {
        		echo $value;
        		$code =0;
        		break;
        	}
        }
        if ($code==1) {
        	$history->$articleId = $articleId;
        	$history = json_encode($history);
        	$themodel->myhistory = $history;
        	$themodel->save();//更新数据
        }
        //获取收藏记录
    	$collection = json_decode($themodel['mycollection']);
    	$code=0;//初始化
    	if($collection!=NULL) {
	    	foreach ($collection as $key => $value) {
	    		if(strcmp($value,$articleId)==0) {//判断是否已经收藏过了
	    			$code = 1; //收藏了置1 否则置 0
	    			break;
	    		}
	    		else $code=0;
	    	}
	    }
    	$giveMark = json_decode($themodel['giveMark']);//获取评分记录
    	$code_1=0;//初始化
    	if($giveMark!=NULL) {
	    	foreach ($giveMark as $key => $value) {
	    		if(strcmp($value,$articleId)==0) {//判断是否已经评分过了
	    			$code_1 = 1; //评分了置1 否则置 0
	    			break;
	    		}
	    		else $code_1=0;
	    	}
	    }
    	$data = ["person"=>$themodel,"collection"=>$code,"giveMark"=>$code_1,"articles"=>$articles];//打包数据
    	$data = json_encode($data);//转化为json
    	return $data;
		    	
	}
	function data_change($score,$articleId)
	{
		$temp = session()->get('id');
		if($score==-1){
			$model = new user;
			$themodel = $model->find($temp);
			$history = json_decode($themodel['mycollection']);
	        $history->$articleId = $articleId;//将值写进去
	        $history = json_encode($history);//转化为json
	        $themodel->mycollection = $history;
	        $themodel->save();//更新数据
	        return 1;
		}elseif($score>=0)
		{
			//文章表修改
			$themodel = article::find($articleId);//得到文章信息
			//dd($themodel);
			//echo $themodel->score;
			$themodel->score = $themodel->score + $score;
			$themodel->gradeNumber = $themodel->gradeNumber + 1;
			//echo $themodel->gradeNumber;
			//exit();
			$themodel->save();//更新数据
			//用户表更新
			$model = new user;
			$themodel = $model->find($temp);
			$history = json_decode($themodel['giveMark']);
	        $history->$articleId = $articleId;//将值写进去
	        $history = json_encode($history);//转化为json
	        $themodel->giveMark = $history;
	        $themodel->save();//更新数据
			return 1;
		}
	}
    
   