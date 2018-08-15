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
                        <a href="">
                            <i class="fa fa-refresh"></i> 刷新列表
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="search-form">
                        <div class="row">
                            <form class="form-horizontal">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">项目名称：</label>
                                        <div class="col-sm-8">
                                            <input id="name" name="name" value="" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">开发方式：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="model">
                                                @if(count($projects) != 0)
                                                    @foreach($projects[0]->model_config() as $k => $val)
                                                        <option value="{{ $k }}">{{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">地区：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="model">
                                                @if(count($projects) != 0)
                                                    @foreach($projects[0]->region_config() as $k => $val)
                                                        <option value="{{ $k }}">{{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">项目状态：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="model">
                                                @if(count($projects) != 0)
                                                    @foreach($projects[0]->status_config() as $k => $val)
                                                        <option value="{{ $k }}">{{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">招投标状态：</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" name="model">
                                                @if(count($projects) != 0)
                                                    @foreach($projects[0]->bs_config() as $k => $val)
                                                        <option value="{{ $k }}">{{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit">筛选</button>
                                    <a href="{{ url('proone/create') }}" class="btn btn-default">创建项目</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered table-striped">
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
                            <!--<th>操作</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->model_config($project->model) }}</td>
                                <td>{{ $project->region_config($project->region) }}</td>
                                <td>{{ $project->status_config($project->status) }}</td>
                                <td>{{ $project->bs_config($project->bidding_status) }}</td>
                                <td>{{ count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->content : '' }}</td>
                                <td>{{ count($project->ProoneRecord) != 0 ? $project->ProoneRecord[0]->Admin->user_name : '' }}</td>
                                <!--
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('proone/update',['id'=>$project->id]) }}" class="btn btn-info btn-sm">修改</a>
                                        <a href="{{ url('proone/delete',['id'=>$project->id]) }}" onclick="if (confirm('您确定删除吗？') == false) return false;" class="btn btn-danger btn-sm">删除</a>
                                    </div>
                                </td>
                                -->
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


</body>

</html>