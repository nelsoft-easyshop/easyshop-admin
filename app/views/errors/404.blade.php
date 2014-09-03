@extends('layouts.default')

@section('description', 'Page Not Found')
@section('keywords', '')
@section('title', 'Page not found | Easyshop Admin')
@section('header_tagline', 'Page Not Found')


@section('page_header')
    @include('includes.header')
@stop

@section('content')
    <hr/>
    <div >
        <span style="font-size: 22px;">Oops, we can't find this page. </span>
    </div>
@stop

