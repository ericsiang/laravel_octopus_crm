@extends('admin.layouts')

@section('head_js');
<script>
    function on_change(mem_id) {
        $.ajax({
            url: '/admin/member/display/' + mem_id + '',
            type: 'post',
            async: false,
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                if (data) {
                    alert('修改成功');
                    location.reload();
                    return;
                }
            },
            error: function (e) {}
        });
    }

    function on_delete(mem_id) {
        if(confirm('確認刪除此會員?')){
            $.ajax({
                url: '/admin/member/' + mem_id + '',
                type: 'post',
                async: false,
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'DELETE'
                },
                success: function (data) {
                    if (data) {
                        alert('刪除成功');
                        location.reload();
                        return;
                    }
                },
                error: function (e) {}
            });
        }
    }

</script>
@endsection
@section('content_header_title','會員列表')

@section('content_header_map')
<li><span>會員管理</span></li>
<li><span>會員列表</span></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>

                    <!--<a href="#" class="fa fa-times"></a>-->
                </div>

                <h2 class="panel-title"> <a href='{{ route('admin.member.create') }}'
                        class="mb-xs mt-xs mr-xs btn btn-success">新增會員</a></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>註冊時間</th>
                                <th>姓名</th>
                                <!--<th>註冊來源</th>-->
                                <th>頻道</th>
                                <th>會員卡號</th>
                                <th>啟用狀態</th>
                                <th>email認證</th>
                                <th>紅利點數</th>
                                <th>功能</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->mem_id }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->cid }}</td>
                                <td>{{ $member->card_num }}</td>
                                <td>{!! $member->status==1 ? '<div class="btn-success mb-xs mt-xs mr-xs btn"><i
                                            class="fa fa-check-circle"></i></div>' : '<div
                                        class="btn-danger mb-xs mt-xs mr-xs btn"><i class="fa fa-times-circle"></i>
                                    </div>' !!}</td>
                                <td>{!! $member->email_auth==1 ? '<div class="btn-success mb-xs mt-xs mr-xs btn"><i
                                    class="fa fa-check-circle"></i></div>' : '<div
                                class="btn-danger mb-xs mt-xs mr-xs btn"><i class="fa fa-times-circle"></i>
                            </div>' !!}
                                </td>
                                <td>{{ $member->points }}</td>
                                <td>
                                    <a href="{{route('admin.member.edit',$member->mem_id)}}"
                                        class="mb-xs mt-xs mr-xs btn btn-info">編輯</a>
                                    <a onClick="on_change({{ $member->mem_id }});"
                                        class="mb-xs mt-xs mr-xs btn btn-@if($member->status==1){{'warning'}}@else{{ 'success'}}@endif">
                                        @if($member->status==1)
                                        禁用
                                        @else
                                        啟用
                                        @endif
                                    </a>
                                    <a class="mb-xs mt-xs mr-xs btn btn-danger"
                                        onClick="on_delete('{{ $member->mem_id }}');">刪除</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_paginate paging_bs_normal" id="datatable-editable_paginate">
                        <ul class="pagination">
                            @php
                                 $getPage=isset($_GET['page']) ? $_GET['page'] : 0;
                                 
                                 $lastPage=$members -> render()->paginator->lastPage();
                            @endphp

                            <li class="prev @if($getPage==1)disabled @endif"><a href="@if($getPage>1) {{ url()->current().'?page='.($getPage-1) }} @else {{ 'javascript:void(0);' }} @endif"><span class="fa fa-chevron-left"></span></a></li>

                            @foreach($members -> render()->elements[0] as $page =>$page_url)
                                <li @if($page==$getPage)class="active"@endif><a href="{{ $page_url }}">{{ $page }}</a></li>
                            @endforeach
                            <!--<li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>-->
                       
                            <li class="next @if($getPage==$lastPage)disabled @endif"><a href="@if($getPage<$lastPage) {{ url()->current().'?page='.($getPage+1) }} @else {{ 'javascript:void(0);' }} @endif"><span class="fa fa-chevron-right"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
