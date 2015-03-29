@extends('layouts.master')

@section('page_title')
确认订单 - 点投
@stop

@section('head')
<style>
    .container-wrapper{
        margin-top:50px;
        margin-bottom:300px;
    }

</style>
@stop
@section('content')

<div class="container-wrapper am-container">
    <form action="{{{action('SubscriptionController@postPaySub', array('sub_order'=>$sub->sub_order))}}}" method="post">
        <h2>确认认购详情</h2>
        <em>订单号：{{{$sub->sub_order}}}</em>
        <hr/>
        <table class="am-table">
            <thead>
                <tr>
                    <th>项目名称</th>
                    <th>认购份数</th>
                    <th>股份占比</th>
                    <th>应付金额</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{{$project->project_name}}}</td>
                    <td>{{{$sub->sub_copies}}}</td>
                    <td>{{{($sub->sub_share * 100).'%'}}}</td>
                    <td>{{{$sub->sub_amt}}}</td>
                </tr>
            </tbody>

        </table>

        <div class="am-u-sm-1 am-u-sm-offset-11"><button type="submit" class="am-btn am-btn-warning ">立即支付</button></div>
    </form>
</div>
@stop

@section('page_js')
<script>
$(function(){
	App.init(['project.index']);
});
</script>
@stop