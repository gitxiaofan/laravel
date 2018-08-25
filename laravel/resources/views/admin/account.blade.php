<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>账户设置</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content ">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>账户设置</h5>
                </div>
                <div class="ibox-content">
                    @include('admin._form_account')
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

<script>
    $().ready(function(){
        var icon = "<i class='fa fa-times-circle'></i> ";
        $('#admin_create').validate({
            rules: {
                nickname: {
                    required: true,
                    minlength: 2
                },
                password: {
                },
                confirm_password: {
                    equalTo: "#password"
                },
                email: {
                    email: true
                }
            },
            messages: {
                nickname: {
                    required: icon + "请输入您的姓名/昵称",
                    minlength: icon + "姓名/昵称必须两个字符以上"
                },
                password: {
                },
                confirm_password: {
                    equalTo: icon + "两次输入的密码不一致"
                },
                email: icon + "请输入正确格式的E-mail"
            }
        });
    });
</script>


</body>

</html>
