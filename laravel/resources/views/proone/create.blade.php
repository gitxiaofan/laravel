@extends('common.layout')

@section('title','创建项目')

@section('css')
    <link href="{{ asset('/assets/admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>创建项目</h5>
                        <div class="ibox-tools">
                            <a href="{{ url('proone/index/'. $type) }}">
                                <i class="fa fa-reply"></i> 返回上一页
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @include('proone._form')
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
    <script src="{{ asset('/assets/admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
        });
    </script>
    <script src="{{ asset('/assets/admin/js/plugins/clockpicker/clockpicker.js') }}"></script>
    <script>
        $('.clockpicker').clockpicker();
    </script>

    <script>
        //表单列表模态框增加
        $(function () {

            $('#shareholder-add').on('click', function () {
                fcl('shareholder','股东权益人');
            });

            $('#operator-add').on('click', function () {
                fcl('operator','作业方');
            });

            $('#p_power-add').on('click', function () {
                fcl('p_power','处理能力');
            });

            $('#s_power-add').on('click', function () {
                fcl('s_power','储存能力');
            });

            $('#product_time-add').on('click', function () {
                fcl('product_time','最终投资决定和投产时间');
            });

            function fcl(primary,name) {
                var count = 0;
                $('#listModal').on('show.bs.modal',function () {
                    var text1 = '添加'+ name;
                    var text2 = name + '：';
                    $('#listModal .modal-title').text(text1);
                    $('#listModal .list-content').text(text2);
                    $('#listModal-add').on('click',function () {
                        if(++count == 1){
                            var list_time = $('input[name="list-time-date"]').val() + ' ' + $('input[name="list-time-clock"]').val();
                            var list_content = $('input[name="list-content"]').val();
                            //console.log(list_time);
                            //console.log(list_content);
                            if(list_time.length == 0 || list_content.length == 0){
                                alert('记录时间或'+ name +'不能为空');
                            }else{
                                var index = primary + '-input-'+ new Date().getTime();
                                var html = '<li>\n' +
                                    '<div class="col-xs-3">'+ list_time +'</div>\n' +
                                    '<div class="col-xs-7">'+ list_content +'</div>\n' +
                                    '<div class="col-xs-2">\n' +
                                    '<div class="myclick fcl-del" data-id="'+ index +'"><i class="fa fa-times"></i> 删除</div>\n' +
                                    '</div>\n' +
                                    '</li>';
                                $('#'+ primary +' ul').append(html);
                                var input = '<input type="hidden" class="'+ index +'" name="'+ primary +'[time][]" value="'+ list_time +'">\n' +
                                    '<input type="hidden" class="'+ index +'" name="'+ primary +'[content][]" value="'+ list_content +'">';
                                $('.main-form').append(input);
                                $('input[name="list-time-date"]').val('');
                                $('input[name="list-time-clock"]').val('');
                                $('input[name="list-content"]').val('');
                                $('#listModal').modal('hide');
                            }
                        }
                    });
                });
            }

            $('.form-control-list').on('click','.fcl-del',function () {
                var input_class = $(this).data('id');
                $('.'+ input_class).remove();
                $(this).closest('li').remove();
            });
        });

    </script>
@endsection
