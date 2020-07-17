@extends('admin.layouts')

@section('head_js');
    <script>
        
    </script>
@endsection
@section('content_header_title','新增頻道')

@section('content_header_map')
    <li><span>頻道列表</span></li>
    <li><span>新增頻道</span></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.channels.channelForm')
        </div>
    </div>
@endsection