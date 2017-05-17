<?php
$temp = $articles;
  $temp = json_encode($temp);
  echo "个人信息JSON展示:"."</br >"."</br >";
  echo ($persons)."</br >"."</br >";
  echo "文章JSON展示:"."</br >"."</br >";;
  echo ($temp);
  //print_r(json_decode($persons));//将个人信息由json转换为数组
 // $persons = json_decode($persons);
  //$articles = json_decode($articles);
  
  //print_r($persons);

  
?>
<form method="post" action="{{url('')}}/json_page">{{ csrf_field() }}
    <ul style="list-style-type: none;">
    <li style="display:inline"><input type="radio" name="kind" value="2">标题</li>
    <li style="display:inline"><input type="radio" name="kind" value="3">热词</li>
    <li style="display:inline"><input type="radio" name="kind" value="4">分类</li>
    <li style="display:inline"><input type="radio" name="kind" value="5">内容</li>
    </ul>
    <input type="text" name="message">
    <input type="submit" value="搜索">
</from>
<h2><a href="{{url('')}}/index">返回内容显示界面</a></h2>
