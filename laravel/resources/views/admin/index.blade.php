<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>管理员列表</title>

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
                    <h5>用户</h5>
                    <div class="ibox-tools">
                        <a href="">
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
                                    <input type="text" name="k" value="" placeholder="请输入关键词" class="input-sm form-control">
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
                            <td>{{ $admin->sex($admin->sex) }}</td>
                            <td>{{ $admin->gid }}</td>
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

<!-- 全局js -->
<script src="{{ asset('/assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('/assets/admin/js/plugins/jeditable/jquery.jeditable.js') }}"></script>

<!-- 自定义js -->
<script src="{{ asset('/assets/admin/js/content.js') }}"></script>


</body>

</html>