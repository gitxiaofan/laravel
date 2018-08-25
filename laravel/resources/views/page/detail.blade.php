<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $page->title }}</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="ibox-tools">
                        <a href="{{ url('page/index') }}">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                    <div class="text-center article-title">
                        <h1>
                            {{ $page->title }}
                        </h1>
                    </div>
                        {!! $page->PageContent->content !!}
                    <hr>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- 全局js -->
<script src="{{ asset('/assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('/assets/admin/js/plugins/jeditable/jquery.jeditable.js') }}"></script>

<!-- 自定义js -->
<script src="{{ asset('/assets/admin/js/content.js') }}"></script>

</body>

</html>
