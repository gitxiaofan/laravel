<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>无操作权限</title>
    <link rel="shortcut icon" href="{{ asset('/assets/admin/favicon.ico') }}">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center">
    <h1>Error</h1>
    <h3 class="font-bold">无操作权限</h3>

    <div class="error-desc">
        抱歉，您无此操作权限~
        <br/>您可以返回主页看看
        <br/><a href="{{ url('index') }}" class="btn btn-primary m-t">主页</a>
    </div>
</div>

<!-- 全局js -->
<script src="{{ asset('/assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.min.js') }}"></script>

</body>

</html>
