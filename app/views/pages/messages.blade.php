@extends('layouts.default')

@section('description', 'Messages of registered users')
@section('keywords', '')
@section('title', 'Message List | Easyshop Admin')
@section('header_tagline', 'Messages Manager.')

@section('page_header')
    @include('includes.header')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.css">
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
                                    <a id="unread" href="/messages">

                                      Inbox
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class='col-md-10'>
                        <div id="mainContent">
                            <div class="table-responsive table-payment"> 
                                <table id="table_id" class="display" style="max-width:100%;">
    <thead>
                                        <tr id="heading">
                                            <th>Message ID</th>
                                            <th>Recipient ID</th>
                                            <th>Sender ID</th>
                                            <th>Recipient</th>
                                            <th>Sender</th>
                                            <th style="max-width:200px;">Message</th>
                                            <th>Time Sent</th>
                                        </tr>
    </thead>
    <tbody >

                @foreach($list_of_messages as $messages)
                        <tr id="testing">
                            <td class="id" >{{{ $messages->id_msg }}}</td>
                            <td class="to_id" >{{{ $messages->to_id }}}</td>
                            <td class="from_id" >{{{ $messages->from_id }}}</td>
                            <td class="recipient">{{{ $messages->recipient }}}</td>
                            <td class="sender">{{{ $messages->sender }}}</td>
                            <td class="message" style="max-width:200px;word-wrap: break-word;"><div id="messageDisplay">{{{ $messages->message }}}</div></td>
                            <td class="time_sent">{{{ $messages->time_sent }}}</td>                          
                        </tr>
                    @endforeach

    </tbody>
</table>

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
 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
  {{ HTML::script('js/src/jquery.shorten.js') }}

{{ HTML::script('js/messages.js') }}


@stop
