<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>管理后台</title>

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

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">

<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img width="70" alt="image" class="img-circle" src="{{ asset('/assets/admin/img/a3.jpg') }}" /></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"></strong></span>
                                <span class="text-muted text-xs block">{{ session()->get('admin')['user_name'] }}<b class="caret"></b></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="J_menuItem" href="">修改头像</a>
                            </li>
                            <li><a class="J_menuItem" href="">个人资料</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{ url('logout') }}">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">P
                    </div>
                </li>
                <li>
                    <a class="J_menuItem" href="{{ url('show') }}"><i class="fa fa-home"></i><span class="nav-label">仪表盘</span></a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">生产平台</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">所有项目</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/create') }}">创建项目</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">钻井平台</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">所有项目</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/create') }}">创建项目</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">生活平台</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">所有项目</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/create') }}">创建项目</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">重吊铺管船</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">所有项目</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/create') }}">创建项目</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">FSRU</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">所有项目</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/create') }}">创建项目</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">LNG模块</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">所有项目</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/create') }}">创建项目</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">水下设施和工程</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/index') }}">所有项目</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('proone/create') }}">创建项目</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-clone"></i>
                        <span class="nav-label">页面</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="">所有页面</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">添加页面</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span class="nav-label">管理员</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{ url('admin/index') }}">所有管理员</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{ url('admin/create') }}">添加管理员</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span class="nav-label">设置</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="">常规设置</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="">短信发送</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="{{ url('show') }}">仪表盘</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="{{ url('logout') }}" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{ url('show') }}" frameborder="0" data-id="{{ url('show') }}" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2018-2025 <a href="/" target="_blank">项目网</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
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

</body>

</html>