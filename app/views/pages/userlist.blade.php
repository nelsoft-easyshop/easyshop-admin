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
    <div class="filter-container">

    </div>
    <div class="tbl-container">
        <div class="input-group srch_div">
            <input type="text" class="form-control">
            <div class="input-group-btn">
                <button type="button" class=" btn btn-primary">
                    <span class=" glyphicon glyphicon-search"></span> SEARCH
                </button>
            </div>
        </div>
        <h4 class="tbl-title">
            <span class="glyphicon glyphicon-list-alt"></span>
            LIST OF REGISTERED USERS
        </h4>
        <div class="tbl-div">
            <table class="table table-striped table-hover tbl-my-style" id="tbl-user-list">
                <thead>
                <tr>
                    <th></th>
                    <th>Date Created</th>
                    <th>Fullname</th>
                    <th>Username</th>
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
                    <td>{{{ $member->created_at }}}</td>
                    <td id="{{{ $member->id_member . '_uname'}}}">{{{ $member->fullname }}}</td>
                    <td>{{{ $member->username }}}</td>
                    <td>{{{ $member->email }}}</td>
                    <td>{{{ (intval($member->gender) === 0) ? 'Male' : 'Female' }}}</td>
                    <td id="{{{ $member->id_member . '_remarks'}}}">{{{ $member->remarks }}}</td>
                    <td id="{{{ $member->id_member . '_address'}}}">{{{ ($member->Address) ? $member->Address->City->location . ' ' . $member->Address->Region->location . ' ' . $member->Address->address : '' }}}</td>
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
                        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span> EDIT USER INFORMATION</h4>
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
                        <div class="form-group">
                            <label>Address : </label>
                            <select name="c_stateregion" class="address_dropdown stateregionselect" data-status="">
                                <option value="0">--- Select State/Region ---</option>
                                @foreach($list_of_location['stateregion_lookup'] as $srkey=>$stateregion)
                                <option class="echo" value="{{{ $srkey }}}" >{{{ $stateregion }}}</option>
                                @endforeach
                            </select>

                            <select name="c_city" class="address_dropdown cityselect" data-status="">
                                <option value="0">--- Select City ---</option>
                                <option class="optionclone" value="" style="display:none;" disabled></option>
                            </select>

                            <select disabled>
                                <option selected="">{{{ $list_of_location['country_name'] }}}</option>
                            </select>
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
