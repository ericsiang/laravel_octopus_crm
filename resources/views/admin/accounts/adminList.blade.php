@extends('admin.layouts')

@section('head_js');
    <script>
        function on_change(acc_id){
            $.ajax({
                url:'/admin/display/'+acc_id+'',
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
    </script>
@endsection
@section('content_header_title','管理員列表')

@section('content_header_map')
    <li><span>管理員列表</span></li>
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
    
                    <h2 class="panel-title"></h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table mb-none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>功能</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->acc_id }}</td>
                                        <td>{{ $account->account }}</td>
                                        <td>
                                        <a href="{{route('admin.edit',$account->acc_id)}}" class="mb-xs mt-xs mr-xs btn btn-danger">編輯</a>    
                                        <a onClick="on_change({{ $account->acc_id }});" class="mb-xs mt-xs mr-xs btn btn-warning">
                                        @if($account->status==1)
                                            隱藏
                                        @else
                                            顯示
                                        @endif
                                        </a>
                                        <a  class="mb-xs mt-xs mr-xs btn btn-danger">刪除</a></td>
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