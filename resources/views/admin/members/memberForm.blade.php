
@if (session()->has('msg'))
    <script>alert('{{ session()->get("msg") }}');</script>
@endif



<form id="form" action="@if (isset($add)){{ route('admin.store')}}@else{{ route('admin.update',$member->mem_id)}}@endif" class="form-horizontal" method="POST">
    
    @csrf
    
    @if (isset($member->mem_id))
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
                <label class="col-sm-3 control-label">Email <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="member" class="form-control" placeholder="" value="@if(isset($member)){{ old('member') ? old('member') : $member->email }}@endif"/>
                    @if($errors->has('member'))
                        <span style="color:#FF0000;">{{ $errors->first('member') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Name <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" placeholder="" value="@if(isset($member)){{ old('name') ? old('name') : $member->name }}@endif"/>
                    @if($errors->has('name'))
                        <span style="color:#FF0000;">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Password <span class="required"> @if (isset($add))*@endif</span></label>
                <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" placeholder="@if (isset($member)){{ '修改密碼時才需填寫' }}@endif" />
                    @if($errors->has('password'))
                        <span style="color:#FF0000;">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">電話 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" placeholder="" value="@if(isset($member)){{ old('phone') ? old('phone') : $member->phone }}@endif"/>
                    @if($errors->has('phone'))
                        <span style="color:#FF0000;">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">電話 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" placeholder="" value="@if(isset($member)){{ old('phone') ? old('phone') : $member->phone }}@endif"/>
                    @if($errors->has('phone'))
                        <span style="color:#FF0000;">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">性別 <span class="required">*</span></label>
                <div class="col-sm-9">
                    <div class="radio-custom radio-primary">
                        <input name="sex" type="radio" value="1" checked>
                        <label for="awesome">男</label>
                    </div>
                    <div class="radio-custom radio-primary">
                        <input  name="sex" type="radio" value="2" @if(isset($member) && $member->sex==2 || old('sex')==2){{  'checked' }}@endif>
                        <label for="very-awesome">女</label>
                    </div>

                    @if($errors->has('sex'))
                        <span style="color:#FF0000;">{{ $errors->first('sex') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">地址<span class="required">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control mb-md" name="city_id">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control mb-md" name="area_id">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div> 
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><span class="required"></span></label>
                <div class="col-sm-6">
                    <input type="text" name="address"" class="form-control" placeholder="" value="@if(isset($member)){{ old('address') ? old('address') : $member->address }}@endif"/>
                    @if($errors->has('address'))
                        <span style="color:#FF0000;">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Submit</button>
                    <a href='@if (isset($add)){{ route('admin.show')}}@else{{ route('admin.edit',$member->mem_id)}}@endif' class="btn btn-default">Reset</a>
                </div>
            </div>
        </footer>
    </section>
</form>
