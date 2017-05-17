<?php
      if(isset($data)) {
      $data = json_decode($data);
      //print_r($data);
      $code_1 = $data->collection;
      $code_2 = $data->giveMark;
      }else{
            $code = json_decode($code);
            echo "收藏或者评分成功";
      }
     // exit();
?>


@if (isset($data))
      <h1>{{$data->articles->title}}</h1>
      <h3>{{$data->articles->text}}</h3>
      @if ( $code_1 ===1 )
            <h2>已经收藏了</h2>
      @else
      <!-- 用ajax传值过来（暂且没有写）   需要数据：文章id（articleId）、、收藏或者评分（score）。是收藏时score=-1  ，评分就直接传评分值  （评分分值大于 0 ）-->
      <form method="post" action="{{url('')}}/functions">{{ csrf_field() }}<!--function 实现各种功能的端口。ajax传参时不会重新加载页面，所以现在临时设置一个form来进行测试-->
      文章id：<input type="text" value="{{$data->articles->articleId}}" name="articleId">
      收藏：<input type="text" value="-1" name = "score">
      <input type="submit"  value="收藏">
      </form>
      @endif
      @if ( $code_2 ===1 )
            <h2>已经评分了</h2>
      @else
      <!-- 用ajax传值过来（暂且没有写）   需要数据：文章id（articleId）、、收藏或者评分（score）。是收藏时score=-1  ，评分就直接传评分值  （评分分值大于 0 ）-->
      <form method="post" action="{{url('')}}/functions">{{ csrf_field() }}<!--function 实现各种功能的端口。ajax传参时不会重新加载页面，所以现在临时设置一个form来进行测试-->
      文章id：<input type="text" value="{{$data->articles->articleId}}" name="articleId">
      评分：<input type="text" value="输入分值" name="score">
      <input type="submit"  value="评分">
      </form>
      @endif
@else


@endif