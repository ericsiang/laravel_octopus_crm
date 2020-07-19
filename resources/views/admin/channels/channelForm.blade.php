@if (session()->has('msg'))
<script>
    alert('{{ session()->get("msg") }}');

</script>
@endif



<form id="form"
    action="@if (isset($add)){{ route('admin.channel.store')}}@else{{ route('admin.channel.update',$channel->id)}}@endif"
    class="form-horizontal" method="POST" enctype="multipart/form-data">

    @csrf

    @if (isset($channel->id))
    <input type="hidden" name="_method" value="PUT" />
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
            @if(!isset($add))
            <div class="form-group" style="padding-left:30%">
                @if(isset($channel->image) && file_exists('storage'.$channel->image))
                <a href="{{ asset('storage'.$channel->image) }}" data-plugin-lightbox=""
                    data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }" title="">
                    <img class="img-responsive" src="{{ asset('storage'.$channel->image) }}" width="145">
                </a>
                @else
                <a href="{{ asset('assets/images/no-image.jpg') }}" data-plugin-lightbox=""
                    data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }" title="">
                    <img class="img-responsive" src="{{ asset('assets/images/no-image.jpg') }}" width="145">
                </a>
                @endif
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
                                <input type="file" name="image" />
                            </span>
                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                    @if($errors->has('image'))
                        <span style="color:#FF0000;">{{ $errors->first('image') }}</span>
                     @endif
                </div>
                
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">頻道名稱 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" placeholder=""
                        value="{{ isset($channel) ?  (old('name') ? old('name') :  ($errors->has('name') ?  '' : $channel->name) )  :  (old('name') ? old('name') :  '')  }}" />
                    @if($errors->has('name'))
                    <span style="color:#FF0000;">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">頻道代碼 <span class="required">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="cid" class="form-control" placeholder=""
                        value="{{ isset($channel) ?  (old('cid') ? old('cid') :   ($errors->has('cid') ?  '' : $channel->cid ) )  :  (old('cid') ? old('cid') :  '')  }}" />
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
                    <a href='@if (isset($add)){{ route('admin.channel.create')}}@else{{ route('admin.channel.edit',$channel->id)}}@endif'
                        class="btn btn-default">Reset</a>
                </div>
            </div>
        </footer>
    </section>
</form>
