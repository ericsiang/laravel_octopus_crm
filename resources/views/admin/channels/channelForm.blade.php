
@if (session()->has('msg'))
    <script>alert('{{ session()->get("msg") }}');</script>
@endif



<form id="form" action="@if (isset($add)){{ route('admin.channel.store')}}@else{{ route('admin.channel.update',$channel->id)}}@endif" class="form-horizontal" method="POST" enctype="multipart/form-data">
    
    @csrf
    
    @if (isset($channel->id))
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
            @if(!$add)
                <div class="form-group" style="padding-left:30%">  
                    <a href="{{ asset('assets/images/no-image.jpg') }}" data-plugin-lightbox="" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }" title="Caption. Can be aligned it to any side and contain any HTML.">
                        <img class="img-responsive" src="{{ asset('assets/images/no-image.jpg') }}" width="145">
                    </a>
                </div>
            @endif
            <div class="form-group">
                <label class="col-md-3 control-label">圖片上傳<span class="required">*</span></label>
                <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="input-append">
                            <div class="uneditable-input">
                                <!--<i class="fa fa-file fileupload-exists"></i>-->
                                <span class="fileupload-preview"></span>
                            </div>
                            <span class="btn btn-default btn-file">
                                <span class="fileupload-exists">Change</span>
                                <span class="fileupload-new">Select file</span>
                                <input type="file" name="image"/>
                            </span>
                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">頻道名稱 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" placeholder="" value="@if(isset($channel)){{ old('name') ? old('name') : $channel->name }}@endif"/>
                    @if($errors->has('name'))
                        <span style="color:#FF0000;">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">頻道代碼 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="cid" class="form-control" placeholder="" value="@if(isset($channel)){{ old('cid') ? old('cid') : $channel->cid }}@endif"/>
                    @if($errors->has('cid'))
                        <span style="color:#FF0000;">{{ $errors->first('cid') }}</span>
                    @endif
                </div>
            </div>

        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Submit</button>
                    <a href='@if (isset($add)){{ route('admin.channel.create')}}@else{{ route('admin.channel.edit',$channel->id)}}@endif' class="btn btn-default">Reset</a>
                </div>
            </div>
        </footer>
    </section>
</form>
