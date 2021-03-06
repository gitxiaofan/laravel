<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>全球油气EPCI项目跟踪系统 - @yield('title')</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="{{ asset('/assets/admin/favicon.ico') }}">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">
    @section('css')

    @show
</head>

<body class="full-height-layout gray-bg top-navigation">

<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        @section('header')
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header" id="myheader">
                    <button id="collapse" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="{{ url('index') }}" class="navbar-brand">
                        <div class="top-logo">
                            <p>全球油气EPCI项目跟踪系统</p>
                            <p class="hidden-xs">Tracing system of International Oil and Gas EPCI Projects</p>
                        </div>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="{{ url('index') }}">首页</a>
                        </li>
                        @if(session()->get('admin')['id'])
                            <li>
                                <a href="{{ url('proone/index/1') }}">生产平台</a>
                            </li>
                            <li>
                                <a href="{{ url('proone/index/2') }}">钻井/生活平台</a>
                            </li>
                            <li>
                                <a href="{{ url('proone/index/3') }}">重吊铺管船</a>
                            </li>
                            <li>
                                <a href="{{ url('proone/index/4') }}">FSRU</a>
                            </li>
                            <li>
                                <a href="{{ url('proone/index/5') }}">LNG模块</a>
                            </li>
                            <li>
                                <a href="{{ url('proone/index/6') }}">水下设施和工程</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('page/detail',['id'=>3]) }}">关于我们</a>
                        </li>
                        <li>
                            <a href="{{ url('page/detail',['id'=>4]) }}">联系我们</a>
                        </li>
                        <li>
                            <a href="{{ url('page/detail',['id'=>6]) }}">报告</a>
                        </li>
                        @if(session()->get('admin')['id'] && session()->get('admin')['gid'] != 3)
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">设置 <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="{{ url('account') }}">账户设置</a></li>
                                    <li><a href="{{ url('page/index') }}">页面</a></li>
                                    <li><a href="{{ url('admin/index') }}">管理员</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            @if(session()->get('admin')['id'])
                                <a href="{{ url('logout') }}">
                                    <i class="fa fa-sign-out"></i> 退出
                                </a>
                            @else
                                <a href="{{ url('login') }}">
                                    <i class="fa fa-sign-out"></i> 登录
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        @show

        @yield('content')

        @section('footer')
        <div class="footer">
            <div class="text-center">
                <strong>Copyright</strong> 全球油气EPCI项目跟踪系统 &copy; 2018
            </div>
        </div>
        @show

    </div>
</div>

<!-- 全局js -->
<script src="{{ asset('/assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/plugins/layer/layer.min.js') }}"></script>

<!-- 自定义js -->
<script src="{{ asset('/assets/admin/js/hplus.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/js/contabs.js') }}"></script>

<!-- 第三方插件 -->
<script src="{{ asset('/assets/admin/js/plugins/pace/pace.min.js') }}"></script>

@section('js')

@show

</body>

</html>
