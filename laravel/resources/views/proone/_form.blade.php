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
<form class="form-horizontal m-t main-form" id="project_create" method="post" action="">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-sm-3 control-label">项目名称：</label>
        <div class="col-sm-8">
            <input id="name" name="name" value="{{ old('name') ? old('name') : $project->name }}" class="form-control" type="text" {{ $detail == 1 ? 'disabled':'' }} >
            @if($detail != 1)<span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 项目名称是必填的</span>@endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">开发方式：</label>
        <div class="col-sm-8">
            <select class="form-control m-b" name="model" {{ $detail == 1 ? 'disabled':'' }}>
                @foreach($project->model_config() as $k => $val)
                <option {{ isset($project->model) && $project->model == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">项目状态：</label>
        <div class="col-sm-8">
            <select class="form-control m-b" name="status" {{ $detail == 1 ? 'disabled':'' }}>
                @foreach($project->status_config() as $k => $val)
                    <option {{ isset($project->status) && $project->status == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">地区：</label>
        <div class="col-sm-8">
            <select class="form-control m-b" name="region" {{ $detail == 1 ? 'disabled':'' }}>
                @foreach($project->region_config() as $k => $val)
                    <option {{ isset($project->region) && $project->region == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">油气田名称：</label>
        <div class="col-sm-8">
            <input id="oil_name" name="oil_name" value="{{ old('oil_name') ? old('oil_name') : $project->oil_name }}" class="form-control" type="text" {{ $detail == 1 ? 'disabled':'' }}>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">油气田描述：</label>
        <div class="col-sm-8">
            <textarea id="oil_desc" name="oil_desc" class="form-control" {{ $detail == 1 ? 'disabled':'' }}>{{ old('oil_desc') ? old('oil_desc') : $project->oil_desc}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">水深：</label>
        <div class="col-sm-8">
            <input id="depth" name="depth" value="{{ old('depth') ? old('depth') : $project->depth }}" class="form-control" type="text" {{ $detail == 1 ? 'disabled':'' }}>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">股东权益人：</label>
        <div class="col-sm-8">
            <div id="shareholder" class="form-control-list">
                <ul class="list-unstyled">
                    <li>
                        <div class="col-xs-3">记录时间</div>
                        <div class="col-xs-7">股东权益人</div>
                        @if($detail != 1)
                        <div class="col-xs-2">操作</div>
                        @endif
                    </li>
                    @if(isset($project->shareholder) && $project->shareholder)
                        @foreach(json_decode($project->shareholder,true) as $key => $item)
                            <li>
                                <div class="col-xs-3">{{ $item['time'] }}</div>
                                <div class="col-xs-7">{{ $item['content'] }}</div>
                                @if($detail != 1)
                                <div class="col-xs-2">
                                    <div class="myclick fcl-del" data-id="{{ 'shareholder-input-'.$key }}"><i class="fa fa-times"></i> 删除</div>
                                </div>
                                @endif
                            </li>
                            <input type="hidden" class="{{ 'shareholder-input-'.$key }}" name="shareholder[time][]" value="{{ $item['time'] }}">
                            <input type="hidden" class="{{ 'shareholder-input-'.$key }}" name="shareholder[content][]" value="{{ $item['content'] }}">
                        @endforeach
                    @endif
                </ul>
                @if($detail != 1)
                <div class="fcl-add">
                    <div class="myclick" id="shareholder-add" data-toggle="modal" data-target="#listModal"><i class="fa fa-plus"></i> 添加</div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">油气田位置：</label>
        <div class="col-sm-8">
            <textarea id="location" name="location" class="form-control" {{ $detail == 1 ? 'disabled':'' }}>{{ old('location') ? old('location') : $project->location}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">作业方：</label>
        <div class="col-sm-8">
            <div id="operator" class="form-control-list">
                <ul class="list-unstyled">
                    <li>
                        <div class="col-xs-3">记录时间</div>
                        <div class="col-xs-7">作业方</div>
                        @if($detail != 1)
                        <div class="col-xs-2">操作</div>
                        @endif
                    </li>
                    @if(isset($project->operator) && $project->operator)
                        @foreach(json_decode($project->operator,true) as $key => $item)
                            <li>
                                <div class="col-xs-3">{{ $item['time'] }}</div>
                                <div class="col-xs-7">{{ $item['content'] }}</div>
                                @if($detail != 1)
                                <div class="col-xs-2">
                                    <div class="myclick fcl-del" data-id="{{ 'operator-input-'.$key }}"><i class="fa fa-times"></i> 删除</div>
                                </div>
                                @endif
                            </li>
                            <input type="hidden" class="{{ 'operator-input-'.$key }}" name="operator[time][]" value="{{ $item['time'] }}">
                            <input type="hidden" class="{{ 'operator-input-'.$key }}" name="operator[content][]" value="{{ $item['content'] }}">
                        @endforeach
                    @endif
                </ul>
                @if($detail != 1)
                <div class="fcl-add">
                    <div class="myclick" id="operator-add" data-toggle="modal" data-target="#listModal"><i class="fa fa-plus"></i> 添加</div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">处理能力：</label>
        <div class="col-sm-8">
            <div id="p_power" class="form-control-list">
                <ul class="list-unstyled">
                    <li>
                        <div class="col-xs-3">记录时间</div>
                        <div class="col-xs-7">处理能力</div>
                        @if($detail != 1)
                        <div class="col-xs-2">操作</div>
                        @endif
                    </li>
                    @if(isset($project->p_power) && $project->p_power)
                        @foreach(json_decode($project->p_power,true) as $key => $item)
                            <li>
                                <div class="col-xs-3">{{ $item['time'] }}</div>
                                <div class="col-xs-7">{{ $item['content'] }}</div>
                                @if($detail != 1)
                                <div class="col-xs-2">
                                    <div class="myclick fcl-del" data-id="{{ 'p_power-input-'.$key }}"><i class="fa fa-times"></i> 删除</div>
                                </div>
                                @endif
                            </li>
                            <input type="hidden" class="{{ 'p_power-input-'.$key }}" name="p_power[time][]" value="{{ $item['time'] }}">
                            <input type="hidden" class="{{ 'p_power-input-'.$key }}" name="p_power[content][]" value="{{ $item['content'] }}">
                        @endforeach
                    @endif
                </ul>
                @if($detail != 1)
                <div class="fcl-add">
                    <div class="myclick" id="p_power-add" data-toggle="modal" data-target="#listModal"><i class="fa fa-plus"></i> 添加</div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">储存能力：</label>
        <div class="col-sm-8">
            <div id="s_power" class="form-control-list">
                <ul class="list-unstyled">
                    <li>
                        <div class="col-xs-3">记录时间</div>
                        <div class="col-xs-7">储存能力</div>
                        @if($detail != 1)
                        <div class="col-xs-2">操作</div>
                        @endif
                    </li>
                    @if(isset($project->s_power) && $project->s_power)
                        @foreach(json_decode($project->s_power,true) as $key => $item)
                            <li>
                                <div class="col-xs-3">{{ $item['time'] }}</div>
                                <div class="col-xs-7">{{ $item['content'] }}</div>
                                @if($detail != 1)
                                <div class="col-xs-2">
                                    <div class="myclick fcl-del" data-id="{{ 's_power-input-'.$key }}"><i class="fa fa-times"></i> 删除</div>
                                </div>
                                @endif
                            </li>
                            <input type="hidden" class="{{ 's_power-input-'.$key }}" name="s_power[time][]" value="{{ $item['time'] }}">
                            <input type="hidden" class="{{ 's_power-input-'.$key }}" name="s_power[content][]" value="{{ $item['content'] }}">
                        @endforeach
                    @endif
                </ul>
                @if($detail != 1)
                <div class="fcl-add">
                    <div class="myclick" id="s_power-add" data-toggle="modal" data-target="#listModal"><i class="fa fa-plus"></i> 添加</div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">招投标状态：</label>
        <div class="col-sm-8">
            <select class="form-control m-b" name="bidding_status" {{ $detail == 1 ? 'disabled':'' }}>
                @foreach($project->bs_config() as $k => $val)
                    <option {{ isset($project->bidding_status) && $project->bidding_status == $k ? 'selected' : '' }} value="{{ $k }}">{{ $val }}</option>
                @endforeach
            </select>
            <textarea name="bs_remark" class="form-control" placeholder="招投标状态备注信息" {{ $detail == 1 ? 'disabled':'' }}>{{ old('bs_remark') ? old('bs_remark') : $project->bs_remark }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">最终投资决定：</label>
        <div class="col-sm-8">
            <div id="product_time" class="form-control-list">
                <ul class="list-unstyled">
                    <li>
                        <div class="col-xs-3">记录时间</div>
                        <div class="col-xs-7">最终投资决定和投产时间</div>
                        @if($detail != 1)
                        <div class="col-xs-2">操作</div>
                        @endif
                    </li>
                    @if(isset($project->product_time) && $project->product_time)
                        @foreach(json_decode($project->product_time,true) as $key => $item)
                            <li>
                                <div class="col-xs-3">{{ $item['time'] }}</div>
                                <div class="col-xs-7">{{ $item['content'] }}</div>
                                <div class="col-xs-2">
                                    <div class="myclick fcl-del" data-id="{{ 'product_time-input-'.$key }}"><i class="fa fa-times"></i> 删除</div>
                                </div>
                            </li>
                            <input type="hidden" class="{{ 'product_time-input-'.$key }}" name="product_time[time][]" value="{{ $item['time'] }}">
                            <input type="hidden" class="{{ 'product_time-input-'.$key }}" name="product_time[content][]" value="{{ $item['content'] }}">
                        @endforeach
                    @endif
                </ul>
                @if($detail != 1)
                <div class="fcl-add">
                    <div class="myclick" id="product_time-add" data-toggle="modal" data-target="#listModal"><i class="fa fa-plus"></i> 添加</div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">项目重大事件记录：</label>
        <div class="col-sm-8">
            <div class="event_record form-control-list">
                <ul class="list-unstyled">
                    <li>
                        <div class="col-sm-3">记录时间</div>
                        <div class="{{ $detail == 1 ? 'col-sm-7' : 'col-sm-5' }}">大事件内容</div>
                        <div class="col-sm-2">记录人</div>
                        @if($detail != 1)
                        <div class="col-sm-2">操作</div>
                        @endif
                    </li>
                    @if(count($project->ProoneRecord) != 0)
                        @foreach($project->ProoneRecord as $key => $item)
                            <li>
                                <div class="col-sm-3">{{ date( 'Y-m-d H:i:s',$item->created_at) }}</div>
                                <div class="{{ $detail == 1 ? 'col-sm-7' : 'col-sm-5' }}">{{ $item->content }}</div>
                                <div class="col-sm-2">{{ $item->Admin->user_name }}</div>
                                @if($detail != 1)
                                <div class="col-sm-2">
                                    <div class="myclick fcl-del" data-id="{{ $item->id }}"><i class="fa fa-times"></i> 删除</div>
                                </div>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            @if($detail != 1)
            <textarea id="event_record" name="event_record" class="form-control">{{ old('event_record') ? old('event_record') : ''}}</textarea>
            @endif
        </div>
    </div>
    @if($detail !== 1)
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-3">
            <button class="btn btn-primary" type="submit">提交</button>
            @if($gid == 1 && $project->id)
                <a href="{{ url('proone/delete',['id'=>$project->id]) }}" onclick="if (confirm('您确定删除吗？') == false) return false;" class="btn btn-danger">删除</a>
                <a href="{{ url('proone/detailtoexcel',['id'=>$project->id]) }}" class="btn btn-info">导出Excel</a>
                <a href="javascript:void(0);" id="btn_print" class="btn btn-info">打印PDF</a>
            @endif
        </div>
    </div>
    @endif
</form>


<div class="modal inmodal" id="listModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">记录时间：</label>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="list-time-date" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group clockpicker" data-autoclose="true">
                            <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                            </span>
                                    <input name="list-time-clock" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label list-content"></label>
                    <div class="col-sm-8">
                        <input name="list-content" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="listModal-add">添加</button>
            </div>
        </div>
    </div>
</div>