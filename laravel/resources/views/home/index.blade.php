@extends('common.layout')

@section('title','首页')

@section('content')

    <div class="wrapper wrapper-content home-show">
        <div class="row">
            <div class="col-sm-4">
                <a href="{{ url('proone/index/1') }}">
                    <div class="ibox home-box">
                        <div class="">
                            <h2>浮式生产装置</h2>
                            <h3>Production Facility，FPSO/Semi/FLNG</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('proone/index/2') }}">
                    <div class="ibox home-box">
                        <div class="">
                            <h2>钻井/生活平台</h2>
                            <h3>Drilling/Accommodation Rig</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('proone/index/3') }}">
                    <div class="ibox home-box">
                        <div class="">
                            <h2>起重/铺管船</h2>
                            <h3>Heavy Lift and Pipelay Vessel</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <a href="{{ url('proone/index/4') }}">
                    <div class="ibox home-box">
                        <div class="">
                            <h2>浮式储存和再气化船</h2>
                            <h3>Floating Storage Regasification Unit</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('proone/index/5') }}">
                    <div class="ibox home-box">
                        <div class="">
                            <h2>液化天然气模块</h2>
                            <h3>LNG Modules</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('proone/index/6') }}">
                    <div class="ibox home-box">
                        <div class="">
                            <h2>水下设施和工程</h2>
                            <h3>Subsea Facility and Construction</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <a href="{{ url('proone/index/7') }}">
                    <div class="ibox home-box">
                        <div class="">
                            <h2>更多项目……</h2>
                            <h3>More Projects……</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
