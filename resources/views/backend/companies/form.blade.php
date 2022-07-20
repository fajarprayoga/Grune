@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>Companies</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $company->page_title }}</li>
    </ol>
</section>
<!-- Main content -->
<section id="main-content" class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-12 row">
                        <div class="col-md-6">
                            <h3 class="box-title">{{ $company->page_title }} </h3>
                        </div>
                        <div class="col-md-6 text-right ">
                            <a href="javascript:history.back()" class="btn  btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if ($company->page_type == 'update')
                        <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data"  id="companies-form">
                            {{method_field('PUT')}}
                    @else
                        {{ Form::open(array('route' => $company->form_action, 'method' => 'POST', 'files' => true, 'id' => 'companies-form')) }}
                        
                    @endif
                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Name</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('name', $company->name, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11' )) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Email</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::email('email', $company->email, 
                                array(
                                    'placeholder' => '', 
                                    'class' => 'form-control validate[required, maxSize[100], funcCall[checkEmail]]', 
                                    'data-prompt-position' => 'bottomLeft:0,11' ,
                                )) 
                            }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Postcode</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content row" >
                            <div class="col-md-2">

                                {{ Form::number('postcode', $company->postcode, array('placeholder' => '', 'id' => 'postcode', 'class' => 'form-control validate[required,]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="btn-search" class="btn btn-primary" >Search</button>
                            </div>
                        </div>
                    </div>

                    
                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title"> Prefecture  </strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::select('prefecture_id', $prefecture, $company->prefecture_id, ['placeholder' => '', 'id' => 'prefecture','class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11']) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">City</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('city', $company->city, array('placeholder' => '', 'id' => 'city','class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11', 'readonly')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Local</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('local', $company->local, array('placeholder' => '', 'id'=>'local', 'class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11', 'readonly')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Street Address</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('street_address', $company->street_address, array('placeholder' => '', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Business Hour</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('business_hour', $company->business_hour, array('placeholder' => '', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Regular Holiday</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('regular_holiday', $company->regular_holiday, array('placeholder' => '', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Phone</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('phone', $company->phone, array('placeholder' => '', 'class' => 'form-control validate[number]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Fax</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('fax', $company->fax, array('placeholder' => '', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">URL</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('url', $company->url, array('placeholder' => '', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">License Number</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('license_number', $company->license_number, array('placeholder' => '', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <?php $img_validation = $company->page_type == 'update' ? '' : 'required'  ?>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Image</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::file('data_image', ['placeholder' => '', 'id' => 'image_file', 'class' => "form-control validate[$img_validation, funcCall[checkImage]]"  , 'data-prompt-position' => 'bottomLeft:0,11']) }}
                            <img src="{{ $company->image ?  asset('uploads/files/' . $company->image) :  asset('img/no-image/no-image.jpg') }}" id="img-upload-tag" alt="" width="50%" style="margin-top: 50px">
                        </div>
                    </div>

                    <div id="form-button" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
                            <button type="submit" name="submit" id="send" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('title', 'Company | ' . env('APP_NAME',''))

@section('body-class', 'custom-select')

@section('css-scripts')
@endsection

@section('js-scripts')
<script src="{{ asset('bower_components/bootstrap/js/tooltip.js') }}"></script>
<!-- validationEngine -->
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine-en.js') }}"></script>
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine.js') }}"></script>
<script src="{{ asset('js/backend/companies/form.js') }}"></script>

<script>
    $(document).ready(() => {

        // Search Prefecture 
        $('#btn-search').click(() => {
            $.ajax({
                type:'GET',
                url: '{{ url("/search-postcode")}}',
                data:'_token = <?php echo csrf_token() ?>',
                 data: {_token:'_token = <?php echo csrf_token() ?>', postcode: $("#postcode").val()},
                dataType: 'json',
                success:function(data) {
                    if(data){
                        $('#city').val(data.city)
                        $('#local').val(data.local)
                        $("#prefecture option").filter(function() {
                            return $(this).text() ==data.prefecture;
                        }).prop("selected", true);
                    }else {
                        $("#prefecture option").prop("selected", false);
                        alert('Postcode empty')
                    }
                }
            });
                  
        })

        // Show Image Seleceted
        $("#image_file").change(function () {
            readURL(this);
        });

        $('#image_file').click(function () {
            var img = "{{ asset('img/no-image/no-image.jpg') }}"
            $('#img-upload-tag').attr('src', img);
        })
            // Reset value when postcode changed
        $("#postcode").keyup(function(){
            $('#city').val('')
            $('#local').val('')
            $("#prefecture option").prop("selected", false);;
        });
    })

    // SHow Image selected
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-upload-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
