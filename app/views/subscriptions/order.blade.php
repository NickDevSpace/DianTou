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
                    <th>投资金额（元）</th>
                    <th>投资股份</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{{$sub->project['project_name']}}}</td>
                    <td>{{{$sub->sub_amt}}}</td>
                    <td>{{{$sub->sub_share}}}%</td>
                </tr>
            </tbody>

        </table>
        <div style="float:right">
            <p>应付款： <span style="font-size:2em; color:#ff4200">￥{{{$sub->sub_amt}}}</span></p>
            <div>
                <button type="submit" class="am-btn am-btn-block am-btn-warning ">立即支付</button>
            </div>
        </div>
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