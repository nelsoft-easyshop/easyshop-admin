@extends('layouts.default')

@section('description', 'Export is too big')
@section('keywords', '')
@section('title', 'Export Warning | Easyshop Admin')
@section('header_tagline', 'Exporting Failed')


@section('page_header')
    @include('includes.header')
@stop

@section('content')
    <hr/>
    <div class="text-center">
        <span style="font-size: 22px;">Whoops, you are trying to generate too big of a file. Our servers can only do so much. Sorry.</span>
    </div>
@stop

