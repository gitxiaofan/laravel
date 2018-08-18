<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--360浏览器优先以webkit内核解析-->


    <title>首页</title>

    <link rel="shortcut icon" href="{{ asset('/assets/admin/favicon.ico') }}">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg home-show">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-4">
            <a href="{{ url('proone/index') }}">
                <div class="ibox home-box">
                    <div class="">
                        <h2>浮式生产装置</h2>
                        <h3>Production Facility，FPSO/Semi/FLNG</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="">
                <div class="ibox home-box">
                    <div class="">
                        <h2>钻井/生活平台</h2>
                        <h3>Drilling/Accommodation Rig</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="">
                <div class="ibox home-box">
                    <div class="">
                        <h2>起重/铺管船</h2>
                        <h3>Heavy Lift and Pipelay Vessel</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <a href="">
                <div class="ibox home-box">
                    <div class="">
                        <h2>浮式储存和再气化船</h2>
                        <h3>Floating Storage Regasification Unit</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="">
                <div class="ibox home-box">
                    <div class="">
                        <h2>液化天然气模块</h2>
                        <h3>LNG Modules</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="">
                <div class="ibox home-box">
                    <div class="">
                        <h2>水下设施和工程</h2>
                        <h3>Subsea Facility and Construction</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <a href="">
                <div class="ibox home-box">
                    <div class="">
                        <h2>更多项目……</h2>
                        <h3>More Projects……</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="{{ asset('/assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/plugins/layer/layer.min.js') }}"></script>

<!-- 自定义js -->
<script src="{{ asset('/assets/admin/js/content.js') }}"></script>

<!-- 欢迎信息 -->
<script src="{{ asset('/assets/admin/js/welcome.js') }}"></script>
</body>

</html>