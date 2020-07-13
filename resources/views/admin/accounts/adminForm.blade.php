
<form id="form" action="forms-validation.html" class="form-horizontal" method="POST">
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
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Account <span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="fullname" class="form-control" placeholder="" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">password <span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" placeholder="" required/>
                </div>
            </div>
           
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Submit</button>
                    <a href='
                    @if (isset($add))
                        {{ route('admin.show')}}
                    @else
                        {{ route('admin.edit',$account->acc_id)}}
                    @endif' class="btn btn-default">Reset</a>
                </div>
            </div>
        </footer>
    </section>
</form>
