@extends('common.layout')

@section('title','用户登录')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="middle-box text-center loginscreen ">
        <div>
            <div>

                <h1 class="logo-name"><i class="fa fa-cubes"></i></h1>

            </div>
            <h3>管理员登陆</h3>

            <form class="m-t" role="form" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="user_name" value="{{ old('user_name') }}" type="text" class="form-control" placeholder="用户名" required>
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="密码" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
                <p class="text-muted text-center">
                    <a href="{{ url('index') }}">返回首页</a> | <a href="{{ url('index',['id' => 4]) }}">联系我们 马上获取账号</a>
                </p>
            </form>
            @if(count($errors))
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection
