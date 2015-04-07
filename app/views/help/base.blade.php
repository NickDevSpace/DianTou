@extends('layouts.master')

@section('page_title')
帮助 - 点投
@stop
@section('head')
<style>

    .content-header{
        margin-top:30px;
    }
</style>
@stop

@section('content')
<div class="content-header am-container">
    <h1>帮助中心</h1>
    <hr/>
</div>
<div class="am-container">
    <div class="col-md-3 am-u-md-3">
        <div class="am-sticky-placeholder" style="height: 842px;">
            <ul class="am-nav">
                <li class="am-nav-header">帮助中心</li>
                <li>
                    <a href="{{{action('HelpController@getShow',array('dtgqzcjj'))}}}"> 点投股权众筹简介 </a>
                </li>
                <li>
                    <a href="{{{action('HelpController@getShow',array('tzgz'))}}}"> 投资规则 </a>
                </li>
                <li>
                    <a href="{{{action('HelpController@getShow',array('rzfw'))}}}"> 融资服务 </a>
                </li>
                <li>
                    <a href="{{{action('HelpController@getShow',array('fxts'))}}}"> 风险提示 </a>
                </li>
                <li>
                    <a href="{{{action('HelpController@getShow',array('ptxy'))}}}"> 平台协议 </a>
                </li>
                <li>
                    <a href="{{{action('HelpController@getShow',array('xszn'))}}}"> 新手指南 </a>
                </li>
                <li>
                    <a href="{{{action('HelpController@getShow',array('rzrxxplgz'))}}}"> 融资人信息披露规则 </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 am-u-md-9">
        @yield('help_content')


    </div>
</div>
@stop
