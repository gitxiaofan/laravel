@if(count($errors))
    <div class="error_message">
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<form class="form-horizontal m-t" id="page_create" method="post" action="">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-sm-3 control-label">标题：</label>
        <div class="col-sm-8">
            <input id="title" name="title" value="{{ old('title') ? old('title') : $page->title }}" class="form-control" type="text" placeholder="填写页面标题">
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 页面标题是必填的</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">内容：</label>
        <div class="col-sm-8">
            <textarea name="content" id="editor" placeholder="填写页面内容">{{ old('content') ? old('content') : (isset($page->PageContent) ? $page->PageContent->content : '') }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-3">
            <button class="btn btn-primary" type="submit">提交</button>
        </div>
    </div>
</form>