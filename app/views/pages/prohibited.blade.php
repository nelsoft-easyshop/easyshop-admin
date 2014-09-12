@extends('layouts.default')

@section('description', 'Prohibited')
@section('keywords', '')
@section('title', 'Prohibited | Easyshop Admin')



@section('content')

    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>

    <div id="banner">
    <p><img src= "{{{ asset('images/img_logo.png') }}}" alt="easyshop" style='margin-top:35px;'></p>
    <p><h3 id='tagline'>&#169;  www.easyshop.ph</h3></p>
    </div>

    <div id="nav">

    <div style=""> 
        <a href="/">
        <img src="{{{ asset('images/es_32x32.png') }}}"/> 
        <span>EASYSHOP</span> 
        </a>
    </div>

    </div>

    <div id="mainsection">  
        <div class="alert alert-danger text-center" role="alert"><h3>Sorry, but you are not authorized to access this page</h3></div>  
    </div>

@stop
