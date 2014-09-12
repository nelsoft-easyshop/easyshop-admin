@extends('layouts.default')

@section('description', 'Raffle Manager')
@section('keywords', '')
@section('title', 'Raffle Manager | Easyshop Admin')
@section('header_tagline', 'Raffle Manager')


@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/src/bootstrap-tokenfield.css')  }}}" rel="stylesheet"  media="screen"/>
@stop


@section('content')
    <div id="mainsection">
  
        <div class='registration_form'>
            {{ Form::open(array('url' => 'doRaffle','class'=>'form-horizontal','id'=>'registration_form', 'files'=>'true')) }}
                <legend>Register Raffle</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label col-xs-2">Raffle Name</label>
                        <div class="col-xs-10">
                            {{ Form::text('raffleName', "", array('class' => 'form-control','id' => 'inputRaffleName','placeholder'=>'Username')) }}
                            <div class='help-block text-center'>{{ $errors->first('username') }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-2">Pool of Possible Winners</label>
                        <div class="col-xs-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id="action">Input Winner</span><span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a id="input">Input Winner</a></li>
                                                <li><a id="upload">Upload CSV File</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->

                                        <div id="divInputWinners"><input type="text" name="poolOfWinner" class="form-control inputWinners" id="poolOfWinners" placeholder="Input pool of winners"></div>
                                        <div id="divUploadWinners" style="display:none"><input type="file" name="uploadPoolOfWinner" class="form-control uploadWinners"  id="uploadPoolOfWinners" placeholder="Upload pool of winners" ></div>
                                        <input type="text" name="winnerType" class="form-control" id="winnerType" value="input" style="display:none;">
                                    </div><!-- /input-group -->
                                </div>                               
                            </div><!-- /.row -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-2">Number of Winners to Generate</label>
                        <div class="col-xs-10">
                            <input type="text" name="numberOfWinners" class="form-control" id="numberOfWinners">
                            <div class='help-block text-center'>{{ $errors->first('fullname') }}</div>
                        </div>
                    </div>                      
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-2">List of Prices</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="listOfPrices" id="listOfPrices">
                            <div class='help-block text-center'>{{ $errors->first('fullname') }}</div>
                        </div>
                    </div>                

                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <input type="submit" id="addRaffle" class="btn btn-primary" value="Add Raffle">
                        </div>
                    </div>

            {{ Form::close() }}



            <div class="modal fade" id="error" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body"  style='text-align:center;'>
                            <img src="{{{ asset('images/img_alert.png') }}}">
                            <div id="changeTextError"></div>  
                        </div>
                    </div>
                </div>
            </div>        
            <div id="rolesDiv">
                <legend>Raffle Lists</legend>                  
                <div class="table-responsive table-payment"> 
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>/</th>
                                <th>Raffle_Name</th>
                                <th>Winners</th>
                                <th>Prices</th>
                            </tr>
                        </thead>

                        @foreach($raffles as $raffle)
                            <tr class="seller_detail">
                                <td class="td_id">


                                <a id="delete" data-id = "{{$raffle->raffle_id}}"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                                <td class="td_username">{{ $raffle->raffle_name }}</td>
                                <td class="td_username">{{ $raffle->winners }}</td>
                                <td class="td_fullname">{{ $raffle->prices }}</td>                          
                            </tr>
                        @endforeach                         

                    </table>
                </div>
            </div>
        </div>
    </div>
  

    
  
@stop

@section('page_js') 
  {{ HTML::script('js/src/bootstrap-tokenfield.js') }}
  {{ HTML::script('js/raffle.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
{{ HTML::script('js/src/jquery.form.js') }}  
@stop

