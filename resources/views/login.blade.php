
@if(count($errors) > 0)
<script type='text/javascript'>alert('验证码错误');history.back(login);</script>
@endif
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="{{ URL::asset('css/logins.css') }}">
<style type="text/css">
	a:hover{color: #9400D3}
</style>
<script type="text/javascript" src="1.php"></script> 
	<title>电子科技大学成都学院登陆界面</title>
</head>
<body>
<index></index>


	<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1492781820135&di=78d19f6b02f5aaaaa1f4e2c388bafc3b&imgtype=0&src=http%3A%2F%2Fpic.58pic.com%2F58pic%2F17%2F63%2F25%2F41x58PICuTs_1024.jpg" width="70px, ">
	
	<h1 id="dian" align="center" style="border:none">电子科技大学成都学院<P>C D U E S T C</P></h1></br>
	   <div class="concent" id="concent" style="border: none;">
	        <div class="login" align="center" style="background-color: rgb(255,255,255);">
	            <p class="login_tit">学生登陆</p>
	            <form id="f" method="post" action="{{url('')}}/indexs">{{ csrf_field()}}
		           <ul>
		                <li class="li1">
			                 <label for="" >用户名</label>
			                 <input type="user" calss="input2" placeholder="User" name="id">
			                 <div></div>
			            </li>  
			            <li class="li2">
			            <label for="">密码</label>
			            <input type="password" class="input1" placeholder="password" name="password">
			            <a href="" class="forget_num">忘记密码?</a>
                        <div class="code" align="center">
		           			<input type="text" name="captcha">
			      		 	<img src="{{captcha_src()}}" onclick="javascript:this.src='{{captcha_src()}}?tm='+Math.random()">
			       		</div>
			           </li>
			       </ul>
                   <div class="log">
		                <input type="submit" class="login_button" value="登陆" >
		                 
	               </div>
		        </form>
	        </div>
	   </div>
	    
	   
	  
	   
	   
	
</body>
</html>
