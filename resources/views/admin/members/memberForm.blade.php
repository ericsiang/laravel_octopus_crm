
@if (session()->has('msg'))
    <script>alert('{{ session()->get("msg") }}');</script>
@endif

<script>

    function on_city(){
        var city_id=$('#city').val();

        $.ajax({
            url:'/admin/member/'+city_id,
            type:'post',
            async:false,
            data:{'_token':'{{ csrf_token() }}'},
            success:function(data){
                //console.log(parse.Json(data));
                if(data){
                    $("#area").empty();
					$("#area").append(data);
                }
            },
            error:function(e){
            }
        });
    }

</script>

<form id="form" action="@if (isset($add)){{ route('admin.member.store')}}@else{{ route('admin.member.update',$member->mem_id)}}@endif" class="form-horizontal" method="POST">
    
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
                    <input type="text" name="email" class="form-control" placeholder="" value="@if(isset($member)){{ old('member') ? old('member') : $member->email }}@endif" @if(isset($member)){{ 'disabled' }}@endif/>
                    @if($errors->has('email'))
                        <span style="color:#FF0000;">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">姓名 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ isset($member) ?  (old('name') ? old('name') :  ($errors->has('name') ?  '' : $member->name) )  :  (old('name') ? old('name') :  '')  }}"/>
                    @if($errors->has('name'))
                        <span style="color:#FF0000;">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">密碼 <span class="required"> @if (isset($add))*@endif</span></label>
                <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" placeholder="@if (isset($member)){{ '需修改密碼時才填寫' }}@endif" />
                    @if($errors->has('password'))
                        <span style="color:#FF0000;">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-sm-3 control-label">電話 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="phone" class="form-control" placeholder="" value="{{ isset($member) ?  (old('phone') ? old('phone') :  ($errors->has('phone') ?  '' : $member->phone) )  :  (old('phone') ? old('phone') :  '')  }}"/>
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
                    <select class="form-control mb-md" name="city_id" id="city" onChange='on_city();'>
                        <option value="">請選擇</option>
                        @php
                            if(isset($citys)){
                                //dd($citys->city_id);
                                foreach($citys as $city){
                                    if(isset($member) && $member->city_id==$city->city_id){
                                        $selected='selected';
                                    }else{
                                        $selected='';
                                    }
                                    echo '<option value="'.$city->city_id.'" '.$selected.'>'.$city->city.'</option>';
                                }
                            }   
                        @endphp    
                    </select>
                    @if($errors->has('city_id'))
                        <span style="color:#FF0000;">{{ $errors->first('city_id') }}</span>
                    @endif
                </div>
  
                <div class="col-sm-3">
                    <select class="form-control mb-md" name="area_id" id="area">
                        <option value="">請選擇</option>
                        @php
                            if(isset($member)){
                                foreach($areas as $area){
                                    if(isset($member) && $member->area_id==$area->area_id){
                                        $selected='selected';
                                    }else{
                                        $selected='';
                                    }

                                    if(isset($member) && $member->city_id==$area->city_id){
                                        echo '<option value="'.$area->area_id.'" '.$selected.'>'.$area->area.'</option>';
                                    }
                                    
                                }
                            }    
                        @endphp
                    </select>
                    @if($errors->has('area_id'))
                        <span style="color:#FF0000;">{{ $errors->first('area_id') }}</span>
                    @endif
                </div> 
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><span class="required"></span></label>
                <div class="col-sm-6">
                    <input type="text" name="address" class="form-control" placeholder="" value="{{ isset($member) ?  (old('address') ? old('address') :  ($errors->has('address') ?  '' : $member->address) )  :  (old('address') ? old('phone') :  '')  }}"/>
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
