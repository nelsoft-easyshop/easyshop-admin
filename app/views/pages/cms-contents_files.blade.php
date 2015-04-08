  @extends('layouts.default')

@section('description', 'Content Manager - Content Files')
@section('keywords', '')
@section('title', 'Content Files CMS | Easyshop Admin')
@section('header_tagline', 'Content Manager - Content Files')


@section('page_header')
    @include('includes.header')
@stop

@section('content')


    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/homecms.css') }}}" rel="stylesheet"  media="screen"/>

   <div class="row">
        <span id="userIdSpan" style="display:none;">{{ $adminObject->id_admin_member }}</span>
        <span id="adminPasswordSpan" style="display:none;">{{ $adminObject->password }}</span>
    <section id="tabs">
        <ul id="myTab" class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#manageSelectDiv" role="tab" data-toggle="tab">Manage Select Node</a></li>
        </ul>
    </section>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="manageSelectDiv">
            @foreach($selectNodes as $nodes)
                <form method="post" action="{{ $contentCmsLink }}/setFeedBanner" class='form-horizontal'>
                    <div class="form-group">

                        <label for="userId" class="col-sm-2 control-label">{{ucwords($nodes->attributes()->id)}}</label>
                        <div class="col-sm-10">
                            {{ Form::text('value', trim($nodes), array('id' => 'value','class' => 'form-control')) }}
                            {{ Form::hidden('id', $nodes->attributes()->id, array('id' => 'id')) }}    
                            {{ Form::hidden('userId', "$adminObject->id_admin_member", array('id' => 'userId')) }}    
                            {{ Form::hidden('password', "$adminObject->password", array('id' => 'adminPassword')) }}    
                            {{ Form::hidden('hash', "", array('id' => 'hash')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div style='text-align:center;padding-top:10px;'>
                            @if($nodes->attributes()->id != "bank-account-number" && $nodes->attributes()->id != "bank-name" && $nodes->attributes()->id != "bank-account-name")
                                <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/setSelect" id="submitSelect" data-checkuser = "1">Submit</a>
                            @else
                                <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/setSelect" id="submitSelect" data-checkuser="0">Submit</a>
                            @endif                                    
                        </div>
                    </div>
                </form> 
            @endforeach                       
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
                    <img src="{{{ asset('images/es_32x32.png') }}}">
                    <h3>Success</h3>        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="error" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>
                    <img src="{{{ asset('images/img_alert.png') }}}">
                    <h3>Please try again</h3>        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="customerror" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>
                    <img src="{{{ asset('images/img_alert.png') }}}">
                    <h3 id="errorTexts">Product slug does not exist</h3>        
                </div>
            </div>
        </div>
    </div>    
    </div>

@stop
@section('page_js') 
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/cms-content.js') }}
{{ HTML::script('js/src/jquery.form.js') }}

@stop

