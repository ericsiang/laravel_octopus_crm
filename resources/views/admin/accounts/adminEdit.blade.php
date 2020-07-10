@extends('admin.layouts')

@section('head_js');
    <script>
        
    </script>
@endsection
@section('content_header_title','編輯管理員')

@section('content_header_map')
    <li><span>管理員列表</span></li>
    <li><span>編輯管理員</span></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
             @include('admin.accounts.adminForm')
        </div>
    </div>
@endsection