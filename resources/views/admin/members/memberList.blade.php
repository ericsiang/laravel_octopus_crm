@extends('admin.layouts')

@section('head_js');
    <script>
        function on_change(mem_id){
            $.ajax({
                url:'/admin/display/'+mem_id+'',
                type:'post',
                async:false,
                data:{'_token':'{{ csrf_token() }}'},
                success:function(data){
                    if(data){
                        alert('修改成功');
                        location.reload();
                        return;
                    }
                },
                error:function(e){
                }
            });
        }

        function on_delete(mem_id){
            $.ajax({
                url:'/admin/'+mem_id+'',
                type:'post',
                async:false,
                data:{'_token':'{{ csrf_token() }}','_method':'DELETE'},
                success:function(data){
                    if(data){
                        alert('刪除成功');
                        location.reload();
                        return;
                    }
                },
                error:function(e){
                }
            });
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
    
                    <h2 class="panel-title"> <a href='{{ route('admin.show') }}' class="mb-xs mt-xs mr-xs btn btn-success" >新增會員</a></h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table mb-none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>註冊時間</th>
                                    <th>姓名</th>
                                    <th>註冊來源</th>
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
                                        <td>{{ $member->member }}</td>
                                        <td>
                                        <a href="{{route('admin.edit',$member->mem_id)}}" class="mb-xs mt-xs mr-xs btn btn-danger">編輯</a>    
                                        <a onClick="on_change({{ $member->mem_id }});" class="mb-xs mt-xs mr-xs btn btn-warning">
                                        @if($member->status==1)
                                            禁用
                                        @else
                                            啟用
                                        @endif
                                        </a>
                                        <a  class="mb-xs mt-xs mr-xs btn btn-danger" onClick="on_delete('{{ $member->mem_id }}');">刪除</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection