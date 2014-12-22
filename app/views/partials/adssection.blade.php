                                    <span style="display:none;">{{$adsSectionIndex = 0}}</span>
                                    <span style="display:none;">{{$adsCount = 1}}</span>
                                    <div class="col-lg-15" style='text-align:center;'>
                                        @foreach($adSection[0] as $ads)
                                            <div style="position:relative;display:inline-block;">
                                                <div class='well' style="height:auto;">
                                                    <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                        <img src="{{$easyShopLink}}/{{$ads->img}}" class="img-responsive" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                    </div>

                                                    <a href="#previewImage" id="editAdsCrop" data-index="{{$adsSectionIndex}}" data-nodename="editAds" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span  data-index="{{$adsSectionIndex}}" data-nodename="editAds" class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                    <a class="btn btn-default" 
                                                        id="removeAdsSection" 
                                                        data-index="{{$adsSectionIndex}}" 
                                                        data-nodename="adsSection" 
                                                        style="position:absolute;top:2px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                     ><font color='red'><b>X</b></font></a>
                                                 </div>
                                                 <span class="adsCount" style="display:none;">{{$adsCount}}</span>
                                                <!--Start Edit Slide Modal -->
                                                    <div class="modal fade user_modal" id="adsPanel{{$adsSectionIndex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Product Panel</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                                                         
                                                                    <form id='adSectionForm{{$adsSectionIndex}}' target="test" action="{{ $newHomeCmsLink}}/setAdsSection" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                                                                        <div id="clone_editAdsCrop_{{$adsSectionIndex}}">
                                                                            {{ Form::hidden('index',$adsSectionIndex, array('id' => 'editAdsIndex','class' => 'form-control')) }}                        
                                                                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
                                                                            <div class="form-group" id="displayFormGroup" style='display:none;'>
                                                                                <label for="inputPassword" class="control-label col-xs-2">Target</label>

                                                                                <div class="col-sm-10">
                                                                                    {{ Form::text('target', $ads->target, array('id' => 'target','class' => 'form-control')) }}                        
                                                                                </div>
                                                                            </div>                                                                               
                                                                            {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                                                                            {{ Form::hidden('hash', "", array('id' => "editAdsSectionHash",'class' => 'form-control')) }}                        
                                                                        </div>

                                                                    </form>                                                                      
                                                                   
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!--End Edit Slide Modal -->

                                            <span style="display:none;">{{$adsSectionIndex++}}</span>  
                                            <span style="display:none;">{{$adsCount++}}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    