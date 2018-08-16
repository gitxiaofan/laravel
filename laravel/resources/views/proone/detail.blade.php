<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>项目详情和招投标状态</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>项目详情和招投标状态</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('proone/index') }}">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h2 class="form-title text-center">{{ $project->name }}</h2>
                    @include('proone._form')
                </div>
            </div>
        </div>
    </div>

</div>


<!-- 全局js -->
<script src="{{ asset('/assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.min.js') }}"></script>

<!-- 自定义js -->
<script src="{{ asset('/assets/admin/js/content.js') }}"></script>

<script src="{{ asset('/assets/admin/js/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

<!-- jQuery Validation plugin javascript-->
<script src="{{ asset('/assets/admin/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/plugins/validate/messages_zh.min.js') }}"></script>

<script src="{{ asset('/assets/admin/js/demo/form-validate-demo.js') }}"></script>



</body>

</html>
