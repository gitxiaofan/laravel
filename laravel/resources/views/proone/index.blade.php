@extends('common.layout')

@section('title','项目列表')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{ $pro_config['type_config'][$type] }}</h5>
                        <div class="ibox-tools">
                            <a href="{{ url('proone/index/'. $type) }}">
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
                                    @if(in_array($type,array(1,2)))
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">
                                                @switch($type)
                                                    @case(1)
                                                    开发方式：
                                                    @break
                                                    @case(2)
                                                    平台型式：
                                                    @break
                                                @endswitch
                                            </label>
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
                                    @endif
                                    @if(in_array($type,array(1)))
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
                                    @endif
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
                                    @if(in_array($type,array(2)))
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">承包商：</label>
                                            <div class="col-sm-8">
                                                <input id="contractor" name="contractor" value="{{ isset($search['contractor']) && $search['contractor'] ? $search['contractor'] : '' }}" class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
                                        <button class="btn btn-primary" type="submit">搜索</button>
                                        @if(session()->get('admin')['gid'] != 3)
                                        <a href="{{ url('proone/create/'.$type) }}" class="btn btn-default">创建项目</a>
                                        <a id="toexcel" href="javascript:void(0);" class="btn btn-default">导出Excel</a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered table-striped" id="main-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>项目名称</th>
                                @if(in_array($type,array(1,2)))
                                <th>
                                    @switch($type)
                                        @case(1)
                                        开发方式
                                        @break
                                        @case(2)
                                        平台型式
                                        @break
                                    @endswitch
                                </th>
                                @endif
                                @if(in_array($type,array(1)))
                                <th>地区</th>
                                @endif
                                @if(in_array($type,array(2)))
                                <th>承包商</th>
                                @endif
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
                                    @if(in_array($type,array(1,2)))
                                    <td>{{ $pro_config['model_config'][$project->model] }}</td>
                                    @endif
                                    @if(in_array($type,array(1)))
                                    <td>{{ $project->region_config($project->region) }}</td>
                                    @endif
                                    @if(in_array($type,array(2)))
                                    <td>{{ $project->contractor }}</td>
                                    @endif
                                    <td>{{ $project->status_config($project->status) }}</td>
                                    <td>{{ $project->bs_config($project->bidding_status) }}</td>
                                    <td>{{ count($project->ProoneRecord) != 0 ? mb_substr($project->ProoneRecord[0]->content,0,32,'utf-8') : '' }}</td>
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
@endsection

@section('js')
    <script src="{{ asset('/assets/admin/js/plugins/jeditable/jquery.jeditable.js') }}"></script>
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
                var toexcel = '{{ url('proone/toexcel/'. $type) }}';
                $('#search-form').attr('action', toexcel);
                $('#search-form').submit();
                $('#search-form').attr('action', '');
            });
        });

    </script>
@endsection
