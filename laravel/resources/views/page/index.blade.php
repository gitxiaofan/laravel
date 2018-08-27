@extends('common.layout')

@section('title','页面列表')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>页面</h5>
                        <div class="ibox-tools">
                            <a href="{{ url('page/index') }}">
                                <i class="fa fa-refresh"></i> 刷新列表
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-9">
                                <a href="{{ url('page/create') }}" class="btn btn-primary ">创建页面</a>
                            </div>
                            <div class="col-sm-3">
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" name="title" value="{{ isset($search['title']) && $search['title'] ? $search['title'] : '' }}" placeholder="请输入标题" class="input-sm form-control">
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
                                <th>页面标题</th>
                                <th>页面URL</th>
                                <th>创建者</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ url('page/detail',['id'=>$page->id]) }}</td>
                                    <td>{{ $page->Admin->user_name }}</td>
                                    <td>{{ date('Y-m-d H:i:s', $page->created_at) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('page/detail',['id'=>$page->id]) }}" class="btn btn-primary btn-sm">浏览</a>
                                            <a href="{{ url('page/update',['id'=>$page->id]) }}" class="btn btn-info btn-sm">修改</a>
                                            <a href="{{ url('page/delete',['id'=>$page->id]) }}" onclick="if (confirm('您确定删除吗？') == false) return false;" class="btn btn-danger btn-sm">删除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12">
                            <nav class="pull-right">
                                {{ $pages->links() }}
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
@endsection

