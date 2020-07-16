
@if (session()->has('msg'))
    <script>alert('{{ session()->get("msg") }}');</script>
@endif



<form id="form" action="@if (isset($add)){{ route('admin.store')}}@else{{ route('admin.update',$account->acc_id)}}@endif" class="form-horizontal" method="POST">
    
    @csrf
    
    @if (isset($account->acc_id))
        <input type="hidden" name="_method" value="PUT"/>
    @endif


    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
               
            </div>

            <h2 class="panel-title"></h2>
            <p class="panel-subtitle">
               
            </p>
        </header>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">Account <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="account" class="form-control" placeholder="" value="@if(isset($account)){{ old('account') ? old('account') : $account->account }}@endif"/>
                    @if($errors->has('account'))
                        <span style="color:#FF0000;">{{ $errors->first('account') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Name <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" placeholder="" value="@if(isset($account)){{ old('name') ? old('name') : $account->name }}@endif"/>
                    @if($errors->has('name'))
                        <span style="color:#FF0000;">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Password <span class="required"> @if (isset($add))*@endif</span></label>
                <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" placeholder="@if (isset($account)){{ '修改密碼時才需填寫' }}@endif" />
                    @if($errors->has('password'))
                        <span style="color:#FF0000;">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
           
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Submit</button>
                    <a href='@if (isset($add)){{ route('admin.show')}}@else{{ route('admin.edit',$account->acc_id)}}@endif' class="btn btn-default">Reset</a>
                </div>
            </div>
        </footer>
    </section>
</form>
