@extends('layouts.default')

@section('description', 'Register Administrator')
@section('keywords', '')
@section('title', 'Register Administrator | Easyshop Admin')
@section('header_tagline', 'Register Administrator')


@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/style.css')  }}}" rel="stylesheet"  media="screen"/>
@stop


@section('content')
    <div id="mainsection">
  
        <div class='registration_form' id="registration_form">
            {{ Form::open(array('url' => 'register','class'=>'form-horizontal','id'=>'form')) }}
                <legend>Register Administrator</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label col-xs-2">Username</label>
                        <div class="col-xs-10">
                            {{ Form::text('username', "", array('class' => 'form-control','id' => 'inputUsername','placeholder'=>'Username')) }}
                            <div class='help-block text-center'>{{ $errors->first('username') }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-2">Password</label>
                        <div class="col-xs-10">
                            {{ Form::password('password', array('class'=>'form-control','placeholder' => 'Password','id'=>'inputPassword')) }}
                            <div class='help-block text-center'>{{ $errors->first('password') }}</div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-2">Fullname</label>
                        <div class="col-xs-10">
                            {{ Form::text('fullname', "", array('class' => 'form-control','id' => 'inputFullname','placeholder'=>'Fullname')) }}                        
                            <div class='help-block text-center'>{{ $errors->first('fullname') }}</div>
                        </div>
                    </div>                

                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <input type="submit" id="btn_register" class="btn btn-primary" value="Register Administrator">
                        </div>
                    </div>

                    @if(isset($success))

                    @endif
            {{ Form::close() }}
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
                        <div class="modal-body"  style='text-align:center;'>
                            <img src="{{{ asset('images/img_alert.png') }}}">
                            <div id="changeTextError"></div>  
                        </div>
                    </div>
                </div>
            </div>      
        <div id="rolesDiv">
            <legend>Manage Roles</legend>                  
                <div class="table-responsive table-payment"> 
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Role</th>
                                <th>Activation</th>
                            </tr>
                        </thead>
                        <span style="display:none">{{$accessor=0}}</span>   
                        @foreach($users as $adminUsers)

                            <tr class="seller_detail">
                                <td class="td_id">{{$adminUsers->id_admin_member}}</td>
                                <td class="td_username">{{$adminUsers->username}}</td>
                                <td class="td_fullname">{{$adminUsers->fullname}}</td>
                                <td class="td_role" style="width:20%;">

                                    <div class="btn-group">
                                      <button class="btn btn-default dropdown-toggle" id="action{{$accessor}}">{{$specificRoles[$accessor][0]->role_name}}</button>
                                      <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            &nbsp;<span class="caret"></span>
                                      </button>

                                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                          @foreach($roles as $adminRoles)
                                            <li><a tabindex="-1" data-role="{{ $adminRoles->role_name }}" data-id = "{{$adminUsers->id_admin_member}}" data-index="{{$index}}" data-action="{{$accessor}}" data-roleid="{{$adminRoles->id_role}}"  id="rolesLink"><span id="myspan{{$index}}">{{ $adminRoles->role_name }}</span></a></li>
                                            <span style="display:none">{{$index++}}</span>
                                          @endforeach
                                      </ul>
                                    </div>
                                </td>
                                <td class="td_activation" style="width:20%;">
                                    <div class="btn-group btn-toggle" > 
                                        @if($adminUsers->is_active == 0)
                                            <button class="btn btn-sm btn-default" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Enabled</button>
                                            <button class="btn btn-sm btn-primary active" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Disabled</button>
                                        @else
                                            <button class="btn btn-sm btn-primary active" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Enabled</button>
                                            <button class="btn btn-sm btn-default" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Disabled</button>                                    
                                        @endif
                                    </div>
                                </td>                         
                            </tr>
                        <span style="display:none">{{$accessor++}}</span>                    
                        @endforeach 
                    </table>
                </div>
        </div>

        </div>

    </div>
  

    
  
@stop

@section('page_js') 
  {{ HTML::script('js/src/register.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
@stop

