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
<form class="form-horizontal m-t" id="admin_create" method="post" action="">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-sm-3 control-label">用户名：</label>
        <div class="col-sm-8">
            <input id="user_name" name="user_name" value="{{ old('user_name') ? old('user_name') : $admin->user_name }}" class="form-control" type="text">
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 用户名是必填的，登陆使用</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">密码：</label>
        <div class="col-sm-8">
            <input id="password" name="password" class="form-control" type="password">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">确认密码：</label>
        <div class="col-sm-8">
            <input id="confirm_password" name="confirm_password" class="form-control" type="password">
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> {{ $admin->password ? '留空为不修改密码':'请再次输入您的密码' }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">权限：</label>
        <div class="col-sm-8">
            <select class="form-control m-b" name="gid">
                @foreach($admin->role_config() as $k => $val)
                    <option {{ isset($admin->gid) && $admin->gid == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">昵称：</label>
        <div class="col-sm-8">
            <input id="nickname" name="nickname" value="{{ old('nickname') ? old('nickname') : $admin->nickname }}" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">手机：</label>
        <div class="col-sm-8">
            <input id="mobile" name="mobile" value="{{ old('mobile') ? old('mobile') : $admin->mobile}}" class="form-control" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">E-mail：</label>
        <div class="col-sm-8">
            <input id="email" name="email" value="{{ old('email') ? old('email') : $admin->email }}" class="form-control" type="email">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">性别：</label>
        <div class="col-sm-8">
            @foreach($admin->sex_config() as $k => $val)
                <div class="radio i-checks checkbox-inline">
                    <label><input type="radio" value="{{ $k }}" {{ isset($admin->sex) && $admin->sex == $k ? 'checked' : '' }} name="sex"> <i></i> {{ $val }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-3">
            <button class="btn btn-primary" type="submit">提交</button>
        </div>
    </div>
</form>