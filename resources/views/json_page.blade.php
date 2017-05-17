<?php
      $temp = $articles;
      $temp = json_encode($temp);
      echo "搜索结果JSON展示"."</br >"."</br >";
      echo ($temp)."</br >";
?>

<h2 style="color:red"><a href="{{url('')}}/json_index">返回JSON展示首页</a></h2>