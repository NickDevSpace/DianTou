@extends('layouts.master')
@section('head')
    <style>
        .get {
            background: #1E5B94;
            color: #fff;
            text-align: center;
            padding: 100px 0;
        }

        .get-title {
            font-size: 200%;
            border: 2px solid #fff;
            padding: 20px;
            display: inline-block;
        }

        .get-btn {
            background: #fff;
        }

        .detail {
            background: #fff;
        }

        .detail-h2 {
            text-align: center;
            font-size: 150%;
            margin: 40px 0;
        }

        .detail-h3 {
            color: #1f8dd6;
        }

        .detail-p {
            color: #7f8c8d;
        }

        .detail-mb {
            margin-bottom: 30px;
        }

        .hope {
            background: #0bb59b;
            padding: 50px 0;
        }

        .hope-img {
            text-align: center;
        }

        .hope-hr {
            border-color: #149C88;
        }

        .hope-title {
            font-size: 140%;
        }

        .about {
            background: #fff;
            padding: 40px 0;
            color: #7f8c8d;
        }

        .about-color {
            color: #34495e;
        }

        .about-title {
            font-size: 180%;
            padding: 30px 0 50px 0;
            text-align: center;
        }

        .footer p {
            color: #7f8c8d;
            margin: 0;
            padding: 15px 0;
            text-align: center;
            background: #2d3e50;
        }
    </style>
@stop

@section('content')
<div class="get">
    <div class="am-g">
        <div class="am-u-lg-12">
            <h1 class="get-title">Amaze UI - HTML5 跨屏前端框架</h1>

            <p>
                期待你的参与，共同打造一个简单易用的前端框架
            </p>

            <p>
                <a href="http://amazeui.org" class="am-btn am-btn-sm get-btn">获取新get技能√</a>
            </p>
        </div>
    </div>
</div>

<div class="detail">
    <div class="am-g am-container">
        <div class="am-u-lg-12">
            <h2 class="detail-h2">One Web 、Any Device，期待和你一起去实现!</h2>

            <div class="am-g">
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

                    <h3 class="detail-h3">
                        <i class="am-icon-mobile am-icon-sm"></i>
                        为移动而生
                    </h3>

                    <p class="detail-p">
                        Amaze UI 采用业内先进的 mobile first 理念，从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-cogs am-icon-sm"></i>
                        组件丰富，模块化
                    </h3>

                    <p class="detail-p">
                        Amaze UI 含近 20 个 CSS 组件、10 个 JS 组件，更有 17 款包含近 60 个主题的 Widgets，可快速构建界面出色、体验优秀的跨屏页面，大幅度提升你的开发效率。
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-check-square-o am-icon-sm"></i>
                        本地化支持
                    </h3>

                    <p class="detail-p">
                        相比国外的前端框架，Amaze UI 专注解决中文排版优化问题，根据操作系统调整字体，实现最佳中文排版效果；针对国内主流浏览器及 App 内置浏览器提供更好的兼容性支持，为你节省大量兼容性调试时间。
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-send-o am-icon-sm"></i>
                        轻量级，高性能
                    </h3>

                    <p class="detail-p">
                        Amaze UI 非常注重性能，基于轻量的 Zepto.js 开发，并使用 CSS3 来做动画交互，平滑、高效，更适合移动设备，让你的 Web 应用可以高速载入。
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hope">
    <div class="am-g am-container">
        <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
            <img src="assets/i/examples/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
            <hr class="am-article-divider am-show-sm-only hope-hr">
        </div>
        <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
            <h2 class="hope-title">同我们一起打造你的前端框架</h2>

            <p>
                在知识爆炸的年代，我们不愿成为知识的过客，拥抱开源文化，发挥社区的力量，参与到Amaze Ui开源项目能获得自我提升。
            </p>
        </div>
    </div>
</div>
@stop