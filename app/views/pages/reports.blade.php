@extends('layouts.default')

@section('description', 'Reports Manager - Home Page')
@section('keywords', '')
@section('title', 'Reports Manager | Easyshop Admin')
@section('header_tagline', 'Reports Manager')

@section('page_header')
    @include('includes.header')
@stop

@section('content')

    <link type="text/css" href="{{{ asset('css/src/jquery.dataTables.css') }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/src/dataTables.tableTools.css') }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>

    <div class="row">
            <section id="tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li  class="active"><a href="#profile2" role="tab" data-toggle="tab"># of uploaded products per account</a></li>
                    <li><a href="#home" role="tab" data-toggle="tab">Monthly Sign Up Statistics</a></li>
                    <li><a href="#profile1" role="tab" data-toggle="tab">Users w/ & w/out Products</a></li>
                    <li><a href="#profile3" role="tab" data-toggle="tab"># of uploaded items per month</a></li>
                    <li><a href="#profile4" role="tab" data-toggle="tab"># of items items per parent category</a></li>
                </ul>
            </section>

            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade" id="home">
                    <div class="table-responsive table-payment"> 
                        <table id="table1" class="display" >
                                <thead>
                                    <tr id="heading">
                                        <th width="45%">Month</th>
                                        <th width="10%"></th>
                                        <th width="45%">Sign-up Count</th>

                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($numberOfSignUps as $row => $signups)
                                        <tr style="height:50px;"><td></td><td style="font-weight:bold;"><font size="5px">{{$yearsOfOperation[$row]}}</font></td><td></td></tr>
                                        @foreach($signups as $key => $data)
                                            <tr>
                                                <td>{{{ $listOfMonths[$key] }}}</td>
                                                <td ></td>
                                                <td>{{{ $data }}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
                    <div class="tab-pane fade" id="profile1">
                        <div class="table-responsive table-payment"> 
                            <table id="table2" class="display" style="max-width:100%;">
                                <thead>
                                    <tr id="heading">
                                        <th>Users w/ Uploaded Products</th>
                                        <th>Users w/out Uploaded Products</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td>{{{$usersWithUploadProducts[0]}}} users</td>
                                        <td>{{{ $usersWithUploadProducts[1] }}} users</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade  in active" id="profile2">
                        <div class="table-responsive table-payment"> 
                            <table id="table3" class="display">
                                <thead>
                                    <tr id="heading">
                                        <th width="50%">Username</th>
                                        <th width="50%"># of Uploaded Products</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($membersProductCounts as $member)
                                        <tr>
                                            <td>{{{$member->username}}}</td>
                                            <td>{{{ $member->uploadCount }}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$membersProductCounts->links()}}                         
                    </div>                    
                    <div class="tab-pane fade" id="profile3">
                        <div class="table-responsive table-payment"> 
                            <table id="table4" class="display">
                                <thead>
                                    <tr id="heading">
                                        <th width="45%">Month</th>
                                        <th width="10%"></th>
                                        <th width="45%">Sign-up Count</th>

                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($uploadedItemsPerMonth as $row => $products)
                                        <tr style="height:50px;"><td></td><td style="font-weight:bold;"><font size="5px">{{$yearsOfOperation[$row]}}</font></td><td></td></tr>
                                        @foreach($products as $key => $data)
                                            <tr>
                                                <td>{{{ $listOfMonths[$key] }}}</td>
                                                <td > </td>
                                                <td>{{{ $data }}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <div class="tab-pane fade" id="profile4">
                        <div class="table-responsive table-payment"> 
                            <table id="table5" class="display" style="max-width:100%;">
                                <thead>
                                    <tr id="heading">
                                 
                                        <th>CategoryNames</th>
                                        <th>CategoryNames</th>

                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($categoryNames as $key => $categories)
                                        <tr>
                                            <td>{{{ $categories }}}</td>
                                            <td>{{$productCountPerCategory[$key]}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>                                        
                    <div class="tab-pane fade" id="dropdown1">
                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                    </div>
                    <div class="tab-pane fade" id="dropdown2">
                        <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!--Start Modal -->
        <div class="modal fade user_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Box Content</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_url" placeholder="Enter fullname">
                        </div>                         
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_sectionIndex" placeholder="Enter fullname">
                        </div>                          
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_boxindex" placeholder="Enter fullname">
                        </div>                        
                        <div class="form-group">
                            <label>Value</label>
                            <input type="text" class="form-control" id="edit_value" placeholder="Enter fullname">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" class="form-control" id="edit_type" placeholder="Enter contact number">
                        </div>
                        <div class="form-group">
                            <label>Target</label>
                            <textarea class="form-control" id="edit_target" rows="3"></textarea>
                        </div>
                        <div class="form-group address_div">
                            <label>Action Type : </label>
                            <div>
                                <select name="c_stateregion" id="drop_actionTypeEdit"  class="form-control" data-status="">
                                    <option value="show product details">show product details</option>
                                    <option value="go to site">go to site</option>
                                    <option value="go to page">go to page</option>

                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="mdl_save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->
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
    
    <div class="modal fade" id="customerror" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>
                    <img src="{{{ asset('images/img_alert.png') }}}">
                    <h4 id="errorTexts"></h4>        
                </div>
            </div>
        </div>
    </div>    



@stop
@section('page_js') 
{{ HTML::script('js/src/jquery.dataTables.js') }}
{{ HTML::script('js/src/dataTables.tableTools.min.js') }}
{{ HTML::script('js/src/jquery.datetimepicker.js') }}
{{ HTML::script('js/src/jquery.form.js') }}
{{ HTML::script('js/reports.js') }}

@stop
