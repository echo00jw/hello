

<h2>搜索结果展示页面</h2>
@foreach ($articles as $i =>$items)
      <ul>
      <li>作者账号：{{$items->uid}}</li>
      <li>文章编号：{{$items->id}}</li>
      <li>作者：{{$items->author}}</li>
      <a href="{{url('')}}/page-{{$items->id}}.html"><li>标题：{{$items->title}}</li></a>
      <li>内容：{{$items->text}}</li>
      <li>发表时间：{{$items->createTime}}</li>
      <li>文章类型：历史={{$items->kind}}</li>
      <li>文章状态：存在={{$items->code}}</li>
      <li>下载数量：{{$items->downNUm}}</li>
      <li>收藏数量：{{$items->collectionNum}}</li>
      <li>浏览数量：{{$items->look}}</li>
      <li>省查状态：通过={{$items->code}}</li>
      <li>是否转载：否={{$items->code}}</li>
      </ul>
@endforeach
<h2 style="color:red"><a href="{{url('')}}/index">返回首页</a></h2>