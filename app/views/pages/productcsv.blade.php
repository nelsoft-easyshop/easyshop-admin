@extends('layouts.default')

@section('description', 'Upload Product CSV')
@section('keywords', '')
@section('title', 'Product CSV Upoad | Easyshop Admin')
@section('header_tagline', 'Product CSV Upload Manager.')

@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/style.css')  }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/src/fileinput.css') }}}" rel="stylesheet"  media="screen"/>

@stop

@section('content')

<div id="mainsection">
        <span class='userid' style="display:none;">{{{ $adminMemberId }}}</span>
        <span class='password' style="display:none;">{{{ $password }}}</span>
        <div class='registration_form' id="registration_form">
            {{ Form::input('hidden', 'productCSVwebservice', $productCSVwebservice, array("id" => "webServiceLink")) }}
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li class=""><a href="#home" role="tab" data-toggle="tab">Upload Product CSV</a></li>
                    <li class="active"><a href="#profile" role="tab" data-toggle="tab">Upload Product Images</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade" id="home">
                        <div class='registration_form'>
                            <div id="data" >
                                <form id="sendToWebservice"></form>
                            </div>            
                            {{ Form::open(array('url' => 'productcsv','enctype'=>'multipart/form-data', "id" => "uploadData", 'method'=>'post')) }}
                                <legend>Upload Product Excel/CSV Data </legend>
                                <div class="form-group">
                                    {{ Form::file('image[]', ['class' => 'file ', 'id' => 'uploadCSV','data-preview-file-type' => 'any']) }}
                                </div>
                            {{ Form::close() }}
                            <a href="{{{ asset('misc/CSV_Upload.xlsx') }}}" class="btn btn-default btn-sm" id="download-btn"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Download CSV Template</a>

                        </div>
                    </div>
                    <div class="tab-pane fade active in" id="profile">
                        <div class='registration_form' id="imageforms">
                            {{ Form::open(array('url' => "#",'enctype'=>'multipart/form-data','id'=>'uploadphoto','method'=>'post')) }}
                                 <legend>Upload Product Images</legend>
                                <div class="form-group">
                                    {{ Form::file('image[]', ['multiple' => true, 'class' => 'file file-loading', 'id' => 'uploadImageOnly','data-preview-file-type' => 'any','accept' => "image/*"]) }}
                                </div>
                                    {{ Form::text('userid', $adminMemberId, ['id' => 'userid']) }}
                                    {{ Form::text('password', $password, ['id' => 'password']) }}                                    
                                    {{ Form::text('hash', '', ['id' => 'hash'])}}
                            {{ Form::close() }}
                                <legend>Images uploaded by the administrator</legend>
                                <div class="form-group">
                                    <div class="col-lg-15" style='text-align:center;width:100% !important;overflow-x: scroll; height:500px !important;'>
                                        @foreach($adminImages as $images)
                                            <div style="position:relative;display:inline-block;">
                                                <div class='well' style="height: 250px;" >
                                                    <a class="btn btn-default" 
                                                       id="removeAdminImage" 
                                                       data-imageid="{{{ $images->id_admin_image }}}"
                                                       data-imagename="{{{ trim($images->image_name) }}}"
                                                       style="position:absolute;top:2px;left:5px;"
                                                    ><font color='red'><b>X</b></font>
                                                    </a>
                                                    <div style="width: 200px; height: 200px;max-width: 200px; max-height: 200px; display: table-cell; vertical-align: middle;">
                                                        <img src="{{{$easyShopLink}}}/assets/admin/{{{$images->image_name}}}" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                        <p>{{{$images->image_name}}}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>                            
                        </div>  

                    </div>

                </div>
            </div>            
        </div>



      
         <div class="modal fade" id="success" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style='text-align:center;'>
                        <img src="{{{ asset('images/es_32x32.png') }}}">
                        <h3>Success</h3>        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="customerror" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style='text-align:center;'>
                        <img src="{{{ asset('images/img_alert.png') }}}">
                        <h4 id="errorTexts">Product slug does not exist</h4>        
                    </div>
                </div>
            </div>
        </div>           
</div>

@stop

@section('page_js')
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/src/fileinput.js') }}
{{ HTML::script('js/src/jquery.form.js') }}
{{ HTML::script('js/productcsv.js') }}


@stop
