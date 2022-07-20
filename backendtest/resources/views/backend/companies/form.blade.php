@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>Company</h1>
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
                    <h3 class="box-title">{{ $company->page_title }}</h3>
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
                        <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data" >
                            {{method_field('PUT')}}
                    @else
                        {{ Form::open(array('route' => $company->form_action, 'method' => 'POST', 'files' => true, 'id' => 'user-form')) }}
                        
                    @endif
                    {{ Form::hidden('id', $company->id, array('id' => 'user_id')) }}
                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Name</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('name', $company->name, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Email</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::email('email', $company->email, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100], email]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Postcode</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content row" >
                            <div class="col-md-2">

                                {{ Form::text('postcode', $company->postcode, array('placeholder' => '', 'id' => 'postcode', 'class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
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
                           {!! Form::select('prefecture_id', $prefecture, $company->prefecture_id, ['placeholder' => '', 'id' => 'prefecture','class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11']) !!}
                           
                           {{--  {!! Form::select($name, $list, $selected, [$options]) !!}  --}}
                           
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">City</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('city', $company->city, array('placeholder' => '', 'id' => 'city','class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Local</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('local', $company->local, array('placeholder' => '', 'id'=>'local', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group ">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Street Date</strong>
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
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Image</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {!! Form::file('data_image', ['placeholder' => '', 'id' => 'image_file', 'class' => 'form-control validate[]', 'data-prompt-position' => 'bottomLeft:0,11']) !!}
                            <img src="{{ asset('uploads/files/' . $company->image) }}" id="img-upload-tag" alt="" width="50%" style="margin-top: 50px">
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

@section('title', 'User | ' . env('APP_NAME',''))

@section('body-class', 'custom-select')

@section('css-scripts')
@endsection

@section('js-scripts')
<script src="{{ asset('bower_components/bootstrap/js/tooltip.js') }}"></script>
<!-- validationEngine -->
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine-en.js') }}"></script>
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine.js') }}"></script>
{{--  <script src="{{ asset('js/backend/users/form.js') }}"></script>  --}}

<script>
    $(document).ready(() => {
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
                        alert('Postcode empty')
                    }
                }
             });
                  
            })
            
            $("#image_file").change(function () {
                readURL(this);
              });
        })

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
