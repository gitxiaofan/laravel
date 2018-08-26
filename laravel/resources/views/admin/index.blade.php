@extends('common.layout')

@section('title','管理员列表')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>管理员</h5>
                        <div class="ibox-tools">
                            <a href="{{ url('admin/index') }}">
                                <i class="fa fa-refresh"></i> 刷新列表
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-9">
                                <a href="{{ url('admin/create') }}" class="btn btn-primary ">创建管理员</a>
                            </div>
                            <div class="col-sm-3">
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" name="user_name" value="{{ isset($search['user_name']) && $search['user_name'] ? $search['user_name'] : '' }}" placeholder="请输入用户名" class="input-sm form-control">
                                        <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>昵称</th>
                                <th>手机号</th>
                                <th>性别</th>
                                <th>角色</th>
                                <th>状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->user_name }}</td>
                                    <td>{{ $admin->nickname }}</td>
                                    <td>{{ $admin->mobile }}</td>
                                    <td>{{ $admin->sex_config($admin->sex) }}</td>
                                    <td>{{ $admin->role_config($admin->gid) }}</td>
                                    <td>{{ $admin->status_config($admin->status) }}</td>
                                    <td>{{ date('Y-m-d H:i:s', $admin->created_at) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('admin/update',['id'=>$admin->id]) }}" class="btn btn-info btn-sm">修改</a>
                                            <a href="{{ url('admin/delete',['id'=>$admin->id]) }}" onclick="if (confirm('您确定删除吗？') == false) return false;" class="btn btn-danger btn-sm">删除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12">
                            <nav class="pull-right">
                                {{ $admins->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
