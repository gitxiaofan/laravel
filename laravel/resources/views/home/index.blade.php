<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>全球油气EPCI项目跟踪系统</title>

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
</head>

<body class="full-height-layout gray-bg top-navigation">

<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header" id="myheader">
                    <button id="collapse" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="#" class="navbar-brand">
                        <div class="top-logo">
                            <p>全球油气EPCI项目跟踪系统</p>
                            <p class="hidden-xs">Tracing system of International Oil and Gas EPCI Projects</p>
                        </div>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a class="J_menuItem" href="{{ url('show') }}">首页</a>
                        </li>
                        @if(session()->get('admin')['id'])
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">生产平台</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">钻井/生活平台</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">重吊铺管船</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">FSRU</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">LNG模块</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">水下设施和工程</a>
                        </li>
                        @endif
                        <li>
                            <a class="J_menuItem" href="">关于我们</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">联系我们</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">报告</a>
                        </li>
                        @if(session()->get('admin')['id'])
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">设置 <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a class="J_menuItem" href="">常规设置</a></li>
                                <li><a class="J_menuItem" href="">页面</a></li>
                                <li><a class="J_menuItem" href="{{ url('admin/index') }}">管理员</a></li>
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
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{ url('show') }}" frameborder="0" data-id="{{ url('show') }}" seamless></iframe>
        </div>
        <div class="footer">
            <div class="text-center">
                <strong>Copyright</strong> 全球油气EPCI项目跟踪系统 &copy; 2018
            </div>
        </div>

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

<script>
    $('#navbar .nav > li > a').click(function () {
        $('#collapse').addClass("collapsed");
        $('#collapse').attr("aria-expanded",false);
        $("#navbar").removeClass("in");
        $("#navbar").attr("aria-expanded",false);
    });
    $('#navbar .dropdown .dropdown-menu > li > a').click(function () {
        $('#navbar .dropdown').removeClass('open');
        $('#navbar .dropdown-toggle').attr("aria-expanded",false);
    });
</script>

</body>

</html>
