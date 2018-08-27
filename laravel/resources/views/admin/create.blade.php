@extends('common.layout')

@section('title','创建管理员')

@section('css')
    <link href="{{ asset('/assets/admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>创建管理员</h5>
                        <div class="ibox-tools">
                            <a href="{{ url('admin/index') }}">
                                <i class="fa fa-reply"></i> 返回上一页
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @include('admin._form')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
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
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        email: true
                    },
                    user_name: {
                        required: true,
                        minlength: 2,
                        remote: {
                            url: "{{ url('admin/check_name') }}",
                            type: "get",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data:{
                                user_name: function(){ return $("#user_name").val(); }
                            }
                        }
                    }
                },
                messages: {
                    nickname: {
                        required: icon + "请输入您的姓名/昵称",
                        minlength: icon + "姓名/昵称必须两个字符以上"
                    },
                    password: {
                        required: icon + "请输入您的密码",
                        minlength: icon + "密码必须5个字符以上"
                    },
                    confirm_password: {
                        required: icon + "请再次输入密码",
                        minlength: icon + "密码必须5个字符以上",
                        equalTo: icon + "两次输入的密码不一致"
                    },
                    email: icon + "请输入正确格式的E-mail",
                    user_name: {
                        required: icon + "请输入用户名",
                        minlength: icon + "用户名必须两个字符以上",
                        remote : icon + "此用户名已被创建"
                    }
                }
            });
        });
    </script>
@endsection
