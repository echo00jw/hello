
<?php

  //print_r(json_decode($person));//将个人信息由json转换为数组
  $data = json_decode($data);
  //$articles = json_decode($articles);
  
  //print_r($data);
  //exit();


?>
<form method="post" action="{{url('')}}/search">{{ csrf_field() }}
    <ul style="list-style-type: none;">
    <li style="display:inline"><input type="radio" name="kind" value="2">标题</li>
    <li style="display:inline"><input type="radio" name="kind" value="3">热词</li>
    <li style="display:inline"><input type="radio" name="kind" value="4">内容</li>
    </ul>
    <input type="text" name="message">
    <input type="submit" value="搜索">
</from>
<div>
  <div style="float:left"><!--热门文章展示-->
    <h2>热门文章展示</h2>
    @foreach ($articles as $i =>$items)
      <ul>
      <li>作者账号：{{$items->uid}}</li>
      <li>文章编号：{{$items->articleId}}</li>
      <li>作者：{{$items->author}}</li>
      <li>标题：{{$items->title}}</li>
      <li>内容：{{$items->text}}</li>
      <li>发表时间：{{$items->createTime}}</li>
      <li>文章类型：历史={{$items->kind}}</li>
      <li>文章状态：存在={{$items->code}}</li>
      <li>下载数量：{{$items->downNum}}</li>
      <li>收藏数量：{{$items->collectNum}}</li>
      <li>浏览数量：{{$items->look}}</li>
      <li>省查状态：通过={{$items->code}}</li>
      <li>是否转载：否={{$items->code}}</li>
      </ul>
      {{$articles->links()}}
    @endforeach
  </div>
  <div><!--个人信息展示-->  
    <h2>个人信息展示</h2>
        <ul> 
          <li>昵称：{{$data->person->name}}</li>
          <li>性别：{{$data->person->sex}}</li>
          <li>密保问题：{{$data->person->question}}</li>
          <li>密保答案：{{$data->person->answer}}</li>
          <li>个性签名：{{$data->person->description}}</li>
          <li>权限：学生={{$data->person->rule}}</li>
          <li>账号状态（正常或者被停止使用）：{{$data->person->code}}</li>
          <li>我的收藏：{{$data->person->mycollection}}</li>
          <li>浏览历史：{{$data->person->myhistory}}</li>
        </ul>
  </div>
</div>
<h2><a href="{{url('')}}/json_index">JSON显示界面</a></h2>