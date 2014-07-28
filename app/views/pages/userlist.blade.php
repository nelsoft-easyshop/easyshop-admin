@extends('layouts.default')

@section('description', 'List of registered users')
@section('keywords', '')
@section('title', 'Users List | Easyshop Admin')
@section('header_tagline', 'Registered Users.')
@section('page_header')
    @include('includes.header')
@stop
@section('javascript')
    @include('includes.js')
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
                            <span class="help-block">This will set if the user can join the ???? .</span>
                            <div class="form-group">
                                <label>Address : </label>
                                <select name="c_stateregion" class="address_dropdown stateregionselect" data-status="<?php #$c_stateregionID?>">
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
    </div>

    <script>
        var mdl_fullname = $('#mdl_fullname');
        var mdl_contact = $('#mdl_contact');
        var mdl_remarks = $('#mdl_remarks');
        var mdl_promo = $('input:radio[name=mdl_promo]');
        var mdl_button = $('#mdl_save');
        var dp1 = $('[name^=c_stateregion]');
        var dp2 = $('[name^=c_city]');
        var mdl_address = $('#mdl_address');
        var jsonCity = {{ $list_of_location['json_city'] }};
        $(document).ready(function()
        {
////////////START OF CITY RETRIEVAL
            function cityFilter(stateregionselect,cityselect){
                var stateregionID = stateregionselect.find('option:selected').attr('value');
                var optionclone = cityselect.find('option.optionclone').clone();
                optionclone.removeClass('optionclone').addClass('echo').attr('disabled', false);
                cityselect.find('option.echo').remove();
                if(stateregionID in jsonCity){
                    jQuery.each(jsonCity[stateregionID], function(k,v){
                        optionclone.attr('value', k).html(v).css('display', 'block');
                        cityselect.append(optionclone.clone());
                    });
                }
                cityselect.trigger('chosen:updated');
            }
            $('#myModal').on('change','.stateregionselect', function(){
                var cityselect = $('#myModal').find('.cityselect');
                cityselect.val(0);
                cityFilter( $(this), cityselect );
            });
////////////END OF CITY
            $('#tbl-user-list').on('click','.edit_btn',function()
            {
                var id = $(this).attr('data');
                var data_obj = $('#tbl-user-list #data_'+id).attr('data');
                PushObjectToFields(data_obj);
            });
            function PushObjectToFields(data_obj=false,data_json=false)
            {
                if(data_obj)
                {
                    var data = eval( '(' + data_obj + ')' );
                    mdl_fullname.val(data.fullname);
                    mdl_contact.val(data.contact_number);
                    mdl_remarks.val(data.remarks);
                    mdl_button.attr('data',data.id);
                    $('#chck_no').prop("checked", true);
                    if(parseInt(data.is_promote) === 1)
                    {
                        $('#chck_yes').prop("checked", true);
                    }
                    dp1.attr('data_status',data.c_stateregionID);
                    dp2.attr('data_status',data.c_cityID);
                    dp1.val(data.c_stateregionID);
                    cityFilter( dp1, dp2 );
                    dp2.val(data.c_cityID);
                    mdl_address.val(data.address);
                }
                else if(data_json)
                {
                    var id = data_json.member.id_member;
                    var obj = '{"id":"' + id +
                        '","fullname":"' + data_json.member.fullname +
                        '","contact_number":"' + data_json.member.contactno +
                        '","remarks":"' + data_json.member.remarks +
                        '","is_promote":"' + data_json.member.is_promo_valid +
                        '","c_stateregionID":"' + data_json.address.stateregion +
                        '","c_cityID":"' + data_json.address.city +
                        '","address":"' + data_json.address.address + '"}';
                    $('.tbl-my-style #' + id + '_uname').html(data_json.member.fullname);
                    $('.tbl-my-style #' + id + '_contact').html(data_json.member.contactno);
                    $('.tbl-my-style #' + id + '_remarks').html(data_json.member.remarks);
                    $('.tbl-my-style #' + id + '_address').html(data_json.address.n_city + ' ' + data_json.address.n_stateregion + ' ' + data_json.address.address);
                    $('.tbl-my-style #data_' + id ).attr('data',obj);
                }
            }
            $('#myModal').on('click','#mdl_save',function()
            {
                var user_id = $(this).attr('data');
                var user_fullname = mdl_fullname.val().trim();
                var user_contact = mdl_contact.val().trim();
                var user_remarks = mdl_remarks.val().trim();
                var user_promo =  $('input:radio[name=mdl_promo]:checked').val();
                var user_cityID = parseInt(dp2.val());
                var user_stateID = parseInt(dp1.val());
                var user_address = mdl_address.val();
                if( user_cityID === 0 || user_stateID === 0 )
                {
                    alert('Invalid Address.');
                    return false;
                }
                $.ajax({
                    url:'UpdateUser',
                    dataType:'JSON',
                    type:'POST',
                    data:{id:user_id,fullname:user_fullname,contact:user_contact,remarks:user_remarks,is_promo_valid:user_promo,city:user_cityID,stateregion:user_stateID,address:user_address},
                    success:function(result){
                        CloseBootstrapModal();
                        PushObjectToFields(false,result);
                    }
                })
            });
            function CloseBootstrapModal(){
                $('#myModal').attr('class','modal fade user_modal').attr('aria-hidden','true').hide();
                $('.modal-backdrop').removeClass('in').remove();
                $('.modal-open').prop('style','').prop('class','');

            }
        });
    </script>
@stop