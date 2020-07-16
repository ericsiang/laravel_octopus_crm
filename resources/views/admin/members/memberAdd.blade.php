@extends('admin.layouts')

@section('head_js');
    <script>
        
    </script>
@endsection
@section('content_header_title','新增管理員')

@section('content_header_map')
    <li><span>會員管理</span></li>
    <li><span>會員列表</span></li>
    <li><span>新增會員</span></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
             @include('admin.members.memberForm')
        </div>
    </div>
@endsection