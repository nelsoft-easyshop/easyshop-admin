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
        <div class="filter-container ">
            <div id="srch_container">
                <h4 class="tbl-title">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                    ADVANCE SEARCH
                </h4>
                {{ Form::open(array('url' => 'users')) }}
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
                            <label for="src_username">Username</label>
                            {{ Form::text('username', Input::old('item'), array('id' => 'src_username', 'class' => 'form-control', 'placeholder' => 'Enter username' ) ) }}
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
                    <input type="text" class="form-control" placeholder="Search all items" />
                </div>
                <div class="input-group-btn">
                    &nbsp;
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Filters
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dd-right" role="menu">
                        <li role="presentation" class="dropdown-header">Search by :</li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Seller</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Brand</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0)" id="btn_advance_search"><span class="glyphicon glyphicon-new-window"></span> View advance search</a></li>
                    </ul>
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
    </div>

<script>
    var jsonCity = {{ $list_of_location['json_city'] }};
    (function ($) {
        var mdl_fullname = $('#mdl_fullname');
        var mdl_contact = $('#mdl_contact');
        var mdl_remarks = $('#mdl_remarks');
        var mdl_promo = $('input:radio[name=mdl_promo]');
        var mdl_button = $('#mdl_save');
        var dp1 = $('[name^=c_stateregion]');
        var dp2 = $('[name^=c_city]');
        var mdl_address = $('#mdl_address');

        jQuery(function(){
            jQuery('#date_timepicker_start').datetimepicker({
                format:'Y/m/d',
                onShow:function( ct ){
                    this.setOptions({
                        maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
                    })
                },
                timepicker:false
            });
            jQuery('#date_timepicker_end').datetimepicker({
                format:'Y/m/d',
                onShow:function( ct ){
                    this.setOptions({
                        minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
                    })
                },
                timepicker:false
            });
        });
        $(document).ready(function(){
            $('#btn_advance_search').on('click',function(){
                $('#srch_container').slideDown();
            });
            $('#btn_close_search').on('click',function(){
                $('#srch_container').slideUp();
            });
        });
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
                    if(parseInt(data.is_promote) === 1) {
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
                    var id = escapeHtml(data_json.id_member);
                    var obj = '{"id":"' + id +
                        '","fullname":"' + escapeHtml(data_json.fullname) +
                        '","contact_number":"' + escapeHtml(data_json.contactno) +
                        '","remarks":"' + escapeHtml(data_json.remarks) +
                        '","is_promote":"' + escapeHtml(data_json.is_promo_valid) +
                        '","c_stateregionID":"' + escapeHtml(data_json.address.region.id_location) +
                        '","c_cityID":"' + escapeHtml(data_json.address.city.id_location) +
                        '","address":"' + escapeHtml(data_json.address.address) + '"}';
                    $('.tbl-my-style #' + id + '_uname').html(escapeHtml(data_json.fullname));
                    $('.tbl-my-style #' + id + '_contact').html(escapeHtml(data_json.contactno));
                    $('.tbl-my-style #' + id + '_remarks').html(escapeHtml(data_json.remarks));
                    $('.tbl-my-style #' + id + '_address').html(data_json.address.city.location + ' ' + data_json.address.region.location + ' ' + escapeHtml(data_json.address.address));
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
                    url:'updateUser',
                    dataType:'JSON',
                    type:'POST',
                    data:{
                        id:user_id,
                        fullname:user_fullname,
                        contact:user_contact,
                        remarks:user_remarks,
                        is_promo_valid:user_promo,
                        city:user_cityID,
                        stateregion:user_stateID,
                        address:user_address},
                    success:function(result){
                        PushObjectToFields(false,result);
                        CloseBootstrapModal();
                    }
                })
            });

            function CloseBootstrapModal(){
                $('.modal.in').modal('hide');
            }
        });
    })(jQuery)
</script>
@stop
