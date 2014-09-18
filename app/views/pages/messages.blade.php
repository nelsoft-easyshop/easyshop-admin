@extends('layouts.default')

@section('description', 'Messages of registered users')
@section('keywords', '')
@section('title', 'Message List | Easyshop Admin')
@section('header_tagline', 'Messages Manager.')

@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/messages.css') }}}" rel="stylesheet"  media="screen"/>
@stop

@section('content')
    <div id="mainsection">
<div id="test"></div>
        <div class="tbl-container">
            <div id="table_keywords">
                <h4 class="tbl-title">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    Partner Messages
                </h4>
                <div class='row'>
                    <div class='col-md-2'>
                        <div id='messages_tabs'>
                            <ul class="nav nav-pills nav-stacked" style="max-width: 260px;">
                                <li class="active">
                                    <a id="unread" href="javascript:void(0)">

                                      Inbox
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class='col-md-10'>
                        <div id="mainContent">
                            <div class="table-responsive table-payment"> 
                                <table class="table table-hover tableSection" >
                                    <thead>
                                        <tr>
                                            <th data="recipient">Recipient</th>
                                            <th data="sender">Sender</th>
                                            <th data="message">Message</th>
                                            <th data="time_sent">Time Sent</th>
                                        </tr>
                                    </thead>

                                        <tbody id="messageList">

                                    @foreach($list_of_messages as $messages)
                                            <tr class="messages_detail">
                                                <td class="id" style="display:none;">{{{ $messages->id_msg }}}</td>
                                                <td class="to_id" style="display:none;">{{{ $messages->to_id }}}</td>
                                                <td class="from_id" style="display:none;">{{{ $messages->from_id }}}</td>
                                                <td class="recipient">{{{ $messages->recipient }}}</td>
                                                <td class="sender">{{{ $messages->sender }}}</td>
                                                <td class="message">{{{ $messages->message }}}</td>
                                                <td class="time_sent">{{{ $messages->time_sent }}}</td>                          
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </div>    
                        </div>                    
                    </div>                        
                </div>
            </div>  
        <div class="clear"></div>
    </div>

<div class="modal fade user_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span> REPLY MESSAGE</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="inputEmail">From:</label>
                                <input type="email" class="form-control" value="" id="fromForm" id="inputEmail" readonly='readonly'  placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Partner:</label>
                                <input type="email" class="form-control" id="partnerForm" id="inputEmail" readonly='readonly' placeholder="Email">
                            </div>    
                            <div class="form-group">
                                <label for="inputPassword">Message</label>
                                <textarea class='form-control' id="messageForm" readonly='readonly'></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Reply</label>
                                <textarea class='form-control' rows="5" cols="5"></textarea>
                            </div>    
                        </form> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="mdl_save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>         
</div>

@stop

@section('page_js')
{{ HTML::script('js/messages.js') }}
@stop
