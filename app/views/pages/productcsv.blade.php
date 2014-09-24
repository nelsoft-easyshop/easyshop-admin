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

        <div class='registration_form' id="registration_form">
        <div id="data" >
            <form id="sendToWebservice"></form>
        </div>            
            {{ Form::open(array('url' => 'productcsv','enctype'=>'multipart/form-data', "id" => "uploadData", 'method'=>'post')) }}
                <legend>Upload Product Excel/CSV Data </legend>
                <div class="form-group">
                    {{ Form::file('image[]', ['multiple' => true, 'class' => 'file ', 'id' => 'uploadCSV','data-preview-file-type' => 'any']) }}
                </div>
            {{ Form::close() }}
            <a href="{{{ asset('misc/CSV_Upload.xlsx') }}}" class="btn btn-default btn-sm" id="download-btn"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Download Template</a>
        </div>
        <div class='help-block text-center disp_error'><h5>{{ $errors->first('noinput') }}</h5></div>
        @if(isset($queryError))
            <div style="color:red;text-align:center;"><h5>Kindly check and fill up all fields with approriate values in the file</h5></div>
        @endif


            <div class='registration_form' id="imageforms">
                {{ Form::open(array('url' => "https://easyshop.ph.local/webservice/productimages",'enctype'=>'multipart/form-data','id'=>'uploadphoto','method'=>'get')) }}
                    <legend>Upload Product Images</legend>
                        <div class="form-group">
                            {{ Form::file('image[]', ['multiple' => true, 'class' => 'file file-loading', 'id' => 'uploadImageOnly','data-preview-file-type' => 'any','accept' => "image/*"]) }}
                        </div>
                {{ Form::close() }}
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
</div>

@stop

@section('page_js')
 
{{ HTML::script('js/src/fileinput.js') }}
{{ HTML::script('js/src/jquery.form.js') }}
{{ HTML::script('js/productcsv.js') }}


@stop
