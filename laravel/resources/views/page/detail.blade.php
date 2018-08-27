@extends('common.layout')

@section('title',$page->title)

@section('content')
    <div class="wrapper wrapper-content  animated">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="text-center article-title">
                            <h1>
                                {{ $page->title }}
                            </h1>
                        </div>
                        {!! $page->PageContent->content !!}
                        <hr>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection