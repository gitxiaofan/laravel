<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>项目列表</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>生产平台</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('proone/index') }}">
                            <i class="fa fa-refresh"></i> 刷新列表
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="search-form">
                        <div class="row">
                            <form id="search-form" class="form-horizontal" type="GET">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">项目名称：</label>
                                        <div class="col-sm-8">
                                            <input id="name" name="name" value="{{ isset($search['name']) && $search['name'] ? $search['name'] : '' }}" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">开发方式：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="model">
                                                <option value="">下拉选择</option>
                                                @foreach($pro_config['model_config'] as $k => $val)
                                                    <option {{ isset($search['model']) && $search['model'] == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">地区：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="region">
                                                <option value="">下拉选择</option>
                                                @foreach($pro_config['region_config'] as $k => $val)
                                                    <option {{ isset($search['region']) && $search['region'] == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">项目状态：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="status">
                                                <option value="">下拉选择</option>
                                                @foreach($pro_config['status_config'] as $k => $val)
                                                    <option {{ isset($search['status']) && $search['status'] == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">招投标状态：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="bidding_status">
                                                <option value="">下拉选择</option>
                                                @foreach($pro_config['bs_config'] as $k => $val)
                                                    <option {{ isset($search['bidding_status']) && $search['bidding_status'] == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit">筛选</button>
                                    <a href="{{ url('proone/create') }}" class="btn btn-default">创建项目</a>
                                    <a id="toexcel" href="javascript:void(0);" class="btn btn-default">导出Excel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered table-striped" id="main-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>项目名称</th>
                            <th>开发方式</th>
                            <th>地区</th>
                            <th>项目状态</th>
                            <th>招投标状态</th>
                            <th>重大事件记录</th>
                            <th>记录人</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                                <tr data-id="{{ $project->id }}" data-src="{{ url($operation,['id'=>$project->id]) }}">
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->model_config($project->model) }}</td>
                                    <td>{{ $project->region_config($project->region) }}</td>
                                    <td>{{ $project->status_config($project->status) }}</td>
                                    <td>{{ $project->bs_config($project->bidding_status) }}</td>
                                    <td>{{ count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->content : '' }}</td>
                                    <td>{{ count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->Admin->user_name : '' }}</td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-12">
                        <nav class="pull-right">
                            {{ $projects->links() }}
                        </nav>
                    </div>
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

<script>
    $(function () {
        $('#main-table tbody tr').click(function () {
            {
                var src = $(this).data('src');
                console.log(src);
                window.location.href = src;
            }
        });

        $('#toexcel').click(function () {
            var toexcel = '{{ url('proone/toexcel') }}';
            $('#search-form').attr('action', toexcel);
            $('#search-form').submit();
            $('#search-form').attr('action', '');
        });
    });

</script>

</body>

</html>