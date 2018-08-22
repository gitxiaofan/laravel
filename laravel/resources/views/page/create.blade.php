<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>创建页面</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/admin/css/plugins/simditor/simditor.css') }}" />
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>创建页面</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('page/index') }}">
                            <i class="fa fa-reply"></i> 返回上一页
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    @include('page._form')
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

<!-- jQuery Validation plugin javascript-->
<script src="{{ asset('/assets/admin/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/plugins/validate/messages_zh.min.js') }}"></script>

<script src="{{ asset('/assets/admin/js/demo/form-validate-demo.js') }}"></script>

<script>
    $().ready(function(){
        var icon = "<i class='fa fa-times-circle'></i> ";
        $('#page_create').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                title: {
                    required: icon + "请输入页面标题",
                    minlength: icon + "标题必须两个字符以上"
                }
            }
        });
    });
</script>

<script type="text/javascript" src="{{ asset('/assets/admin/js/plugins/simditor/module.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/js/plugins/simditor/uploader.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/js/plugins/simditor/hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/js/plugins/simditor/simditor.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        var editor = new Simditor({
            textarea: $('#editor'),
            //defaultImage: '/assets/admin/img/a9.jpg',
            placeholder : '这里输入内容...',
            pasteImage: true,
            toolbarFloat:true,
            toolbar : toolbar,  //工具栏
            upload : {
                url : '{{ url('page/upload') }}', //文件上传的接口地址
                params: '', //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
                fileKey: 'photo', //服务器端获取文件数据的参数名
                connectionCount: 3,
                leaveConfirm: '正在上传文件'
            }
        });
    });
</script>


</body>

</html>
