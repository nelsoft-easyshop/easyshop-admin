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
    <link type="text/css" href="{{{ asset('css/homecms.css') }}}" rel="stylesheet"  media="screen"/>

   <div class="row">

    <section id="tabs">
        <ul id="myTab" class="nav nav-tabs" role="tablist">
            <li class="dropdown ">
                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Manage Feeds <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                    <li><a href="#addFeaturedProduct" tabindex="-1" role="tab" data-toggle="tab">Add Featured Product</a></li>
                    <li><a href="#addPopularItemsDiv" tabindex="-1" role="tab" data-toggle="tab">Add Popular Items</a></li>
                    <li><a href="#addfeedPromoItems" tabindex="-1" role="tab" data-toggle="tab">Add Promo Items</a></li>
                </ul>
            </li>
            <li><a href="#manageFeedBannerDiv" role="tab" data-toggle="tab">Manage Feed Banner</a></li>
            <li class="active"><a href="#manageSelectDiv" role="tab" data-toggle="tab">Manage Select Node</a></li>

        </ul>
    </section>

    <div id="myTabContent" class="tab-content">

    </div>


    </div>

    <div class="modal fade" id="loading" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;`'>
                    <img src="{{{ asset('images/orange_loader.gif') }}}">
                    <h3>Please Wait..</h3>        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="success" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>

                    <h3>Success</h3>        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="error" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>

                    <h3>Please try again</h3>        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="customerror" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>

                    <h3 id="errorTexts">Product slug does not exist</h3>        
                </div>
            </div>
        </div>
    </div>    
    </div>

@stop
@section('page_js') 
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/cms.js') }}
{{ HTML::script('js/src/jquery.form.js') }}

@stop

