@extends('layouts.default')

@section('description', 'Mobile Content Manager - Home Page')
@section('keywords', '')
@section('title', 'Mobile Home CMS | Easyshop Admin')
@section('header_tagline', 'Mobile Content Manager - Home Page')

@section('page_header')
    @include('includes.header')
@stop

@section('content')

    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>
    <div class="row">
        <section id="tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#test1" role="tab" data-toggle="tab">Test1</a></li>
                <li><a href="#test2" role="tab" data-toggle="tab">Test2</a></li>
                <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Manage Section Nodes<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <li><a href="#test3" tabindex="-1" role="tab" data-toggle="tab">Test</a></li>
                        <li><a href="#test4" tabindex="-1" role="tab" data-toggle="tab">Test</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="test1">
                <p>Test1</p>
            </div>
            <div class="tab-pane fade active in" id="test2">
                <p>Test2</p>
            </div>   
            <div class="tab-pane fade active in" id="test3">
                <p>Test3</p>
            </div>            
            <div class="tab-pane fade active in" id="test4">
                <p>Test4</p>
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
                    <h4 id="errorTexts"></h4>        
                </div>
            </div>
        </div>
    </div>        

@stop
@section('page_js') 
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/cms_newhome.js') }}
{{ HTML::script('js/src/jquery.form.js') }}

@stop
