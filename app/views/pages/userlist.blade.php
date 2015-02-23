@extends('layouts.default')

@section('description', 'List of registered users')
@section('keywords', '')
@section('title', 'Users List | Easyshop Admin')
@section('header_tagline', 'Registered Users.')

@section('page_header')
    @include('includes.header')
@stop

@section('content')
    <div id="mainsection">
        <div class="filter-container ">
            <div id="srch_container">
                <h4 class="tbl-title">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                    ADVANCE SEARCH
                </h4>
                {{ Form::open(array('url' => 'users', 'id' => 'searchForm')) }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_timepicker_start">Start Date</label>
                            <div class="inner-addon left-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                {{ Form::text('startdate', Input::old('startdate'), array('id' => 'date_timepicker_start', 'class' => 'form-control' ) ) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="date_timepicker_end">End Date</label>
                            <div class="inner-addon left-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                {{ Form::text('enddate', Input::old('enddate'), array('id' => 'date_timepicker_end', 'class' => 'form-control' ) ) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="src_fullname">Fullname</label>
                            {{ Form::text('fullname', Input::old('fullname'), array('id' => 'src_fullname', 'class' => 'form-control', 'placeholder' => 'Enter fullname' ) ) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="src_storename">Store Name</label>
                            {{ Form::text('store_name', Input::old('item'), array('id' => 'src_storename', 'class' => 'form-control', 'placeholder' => 'Enter Store Name' ) ) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="src_number">Contact number</label>
                            {{ Form::text('number', Input::old('number'), array('id' => 'src_number', 'class' => 'form-control', 'placeholder' => 'Enter number' ) ) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="src_email">Username</label>
                            {{ Form::text('username', Input::old('username'), array('id' => 'src_username', 'class' => 'form-control', 'placeholder' => 'Enter username' ) ) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="src_email">Email</label>
                            {{ Form::text('email', Input::old('email'), array('id' => 'src_email', 'class' => 'form-control', 'placeholder' => 'Enter email' ) ) }}
                        </div>
                    </div>
                    <div class="col-md-1 col-md-offset-2">
                        <div class="form-group">
                            <label for="btn_close_search">&nbsp</label>
                            <button type="button" id="btn_close_search" class="btn btn-default"> Cancel </button>
                        </div>
                    </div>                    
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="btn_search">&nbsp</label>
                            {{ Form::submit(' Search ', array('id' => 'btn_search', 'class' => 'btn btn-primary')) }}
                        </div>
                    </div>                    
                </div>



                {{ Form::close() }}
            </div>
        </div>
        <div class="tbl-container">
            <div class="input-group srch_div">
                <div class="inner-addon left-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="text" id="searchBox"  class="form-control" placeholder="Search all items" />
                </div>
                <div class="input-group-btn">
                    &nbsp;
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Filters
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dd-right" role="menu">
                        <li role="presentation" class="dropdown-header">Search by :</li>
                        <li><a class="drct_search" data="src_fullname" href="javascript:void(0)">Fullname</a></li>
                        <li><a class="drct_search" data="src_username" href="javascript:void(0)">Username</a></li>
                        <li><a class="drct_search" data="src_storename" href="javascript:void(0)">Store Name</a></li>
                        <li><a class="drct_search" data="src_number" href="javascript:void(0)">Contact Number</a></li>
                        <li><a class="drct_search" data="src_email" href="javascript:void(0)">Email</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0)" id="btn_advance_search"><span class="glyphicon glyphicon-new-window"></span> View advance search</a></li>
                    </ul>
                </div>
            </div>
        <h4 class="tbl-title">
            <span class="glyphicon glyphicon-list-alt"></span>
            LIST OF REGISTERED USERS : {{{$member_count[0]->memberCount}}} 
        </h4>
        <div class="tbl-div">
            <table class="table table-striped table-hover tbl-my-style" id="tbl-user-list">
                <thead>
                <tr>
                    <th></th>
                    <th>Date Created</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Store Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Remarks</th>
                    <th>Address</th>
                    <th>No. uploaded Products</th>
                    <th>Contact Number</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_of_member as $member)
                <tr id="tr_{{{ $member->id_member }}}">
                    <td>
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger edit_btn"  data-toggle="modal" data-target="#myModal" data="{{{ $member->id_member }}}">
                                    <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                        <span class='data_container' id='data_{{{ $member->id_member }}}'
                                              data='{"id":"{{{ $member->id_member }}}","fullname":"{{{ $member->fullname }}}","contact_number":"{{{ $member->contactno }}}","remarks":"{{{ $member->remarks }}}","is_promote":"{{{ $member->is_promo_valid }}}","c_stateregionID":"{{{ (isset($member->Address->stateregion)) ? $member->Address->stateregion : "" }}}" , "c_cityID":"{{{ (isset($member->Address->city)) ? $member->Address->city : "" }}}" , "address":"{{{ (isset($member->Address->address)) ? $member->Address->address : "" }}}" } '>
                                        </span>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>{{{ $member->datecreated }}}</td>
                    <td id="{{{ $member->id_member . '_uname'}}}">{{{ $member->fullname }}}</td>
                    <td>{{{ $member->username }}}</td>
                    <td>{{{ $member->getStoreName() }}}</td>
                    <td>{{{ $member->email }}}</td>
                    <td>{{{ (intval($member->gender) === 0) ? 'Male' : 'Female' }}}</td>
                    <td id="{{{ $member->id_member . '_remarks'}}}">{{{ $member->remarks }}}</td>
                    <td id="{{{ $member->id_member . '_address'}}}">{{{ ($member->Address && $member->Address->City->location && $member->Address->Region->location) ? $member->Address->City->location . ' ' . $member->Address->Region->location . ' ' . $member->Address->address : '' }}}</td>
                    <td>{{{ ($member->Product(true)) ? $member->Product(true)->count() : 0 }}}</td>
                    <td id="{{{ $member->id_member . '_contact'}}}">{{{ $member->contactno }}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $list_of_member->links() }}
        <div class="clear"></div>
        <!--Start Modal -->
        <div class="modal fade user_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span> EDIT USER INFORMATION</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" id="mdl_fullname" placeholder="Enter fullname">
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" id="mdl_contact" placeholder="Enter contact number">
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" id="mdl_remarks" rows="3"></textarea>
                        </div>
                        <label>Is Promo Valid </label>
                        <div class="checkbox">
                            <label class="radio-inline">
                                <input type="radio" name="mdl_promo" id="chck_yes" value="1"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="mdl_promo" id="chck_no" value="0"> No
                            </label>
                        </div>
                        <span class="help-block">This will set if the user can join the promo .</span>
                        <label>Is Banned </label>
                        <div class="checkbox">
                            <label class="radio-inline">
                                <input type="radio" name="mdl_ban" id="ban_chck_yes" value="1"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="mdl_ban" id="ban_chck_no" value="0"> No
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Ban type </label>
                            <select id="ban_dropdown" class="form-control" data-status="">
                                <option value="0">--- Select Ban Type ---</option>
                                @foreach($list_of_ban_type as $key=> $data)
                                <option class="ban-type-opt" value="{{{ $key }}}" >{{{ $data['message'] }}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group address_div">
                            <label>Address : </label>
                            <div>
                                <select name="c_stateregion" class="address_dropdown stateregionselect form-control" data-status="">
                                    <option value="0">--- Select State/Region ---</option>
                                    @foreach($list_of_location['stateregion_lookup'] as $srkey=>$stateregion)
                                    <option class="echo" value="{{{ $srkey }}}" >{{{ $stateregion }}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select name="c_city" class="address_dropdown cityselect form-control" data-status="">
                                    <option value="0">--- Select City ---</option>
                                    <option class="optionclone" value="" style="display:none;" disabled></option>
                                </select>
                            </div>
                            <div>
                                <select disabled class="form-control">
                                    <option selected="">{{{ $list_of_location['country_name'] }}}</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" id="mdl_address" placeholder="Enter complete address">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="mdl_save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->
    </div>
    <div id="jsonData" data = "{{{ $list_of_location['json_city'] }}}"></div>
</div>

@stop

@section('page_js')
{{ HTML::script('js/userlist.js') }}
@stop
