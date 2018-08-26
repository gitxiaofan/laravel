@extends('common.layout')

@section('title','无操作权限')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="middle-box text-center">
            <h1>Error</h1>
            <h3 class="font-bold">无操作权限</h3>

            <div class="error-desc">
                抱歉，您无此操作权限~
                <br/>您可以返回主页看看
                <br/><a href="{{ url('index') }}" class="btn btn-primary m-t">主页</a>
            </div>
        </div>
    </div>

@endsection
