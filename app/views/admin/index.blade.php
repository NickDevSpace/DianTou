@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>Welcome</small></div>
</div>
<ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
  <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>新增项目审核<br/>2300</a></li>
  <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>新增用户审核<br/>308</a></li>
  <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日访问<br/>80082</a></li>
  <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/>3000</a></li>
</ul>

@stop