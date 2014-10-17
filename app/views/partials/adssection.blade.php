                                    <span style="display:none;">{{$adsSectionIndex = 0}}</span>
                                    <span style="display:none;">{{$adsCount = 1}}</span>
                                    <div class="col-lg-15" style='text-align:center;'>
                                        @foreach($adSection[0] as $ads)
                                            <div style="position:relative;display:inline-block;">
                                                <div class='well' style="height:auto;">
                                                    <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                        <img src="{{$easyShopLink}}{{$ads->img}}" class="img-responsive" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                    </div>

                                                    <a href="#adsPanel{{$adsSectionIndex}}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                    <a class="btn btn-default" 
                                                        id="removeAdsSection" 
                                                        data-index="{{$adsSectionIndex}}" 
                                                        data-nodename="adsSection" 
                                                        style="position:absolute;top:2px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                     ><font color='red'><b>X</b></font></a>

                                                    <a 
                                                        id="moveupAdsSection" 
                                                        data-action="up" 
                                                        data-index="{{$adsSectionIndex}}" 
                                                        data-order="{{$adsSectionIndex}}" 
                                                        style="position:absolute;top:235px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/setPositionAdsSection"
                                                     ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                                     <a  
                                                        id="movedownAdsSection" 
                                                        data-action="down" 
                                                        data-index="{{$adsSectionIndex}}" 
                                                        data-order="{{$adsSectionIndex}}" 
                                                        style="position:absolute;top:235px;right:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/setPositionAdsSection"
                                                     ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
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

                                                                        
                                                                        {{ Form::hidden('index',$adsSectionIndex, array('id' => 'index','class' => 'form-control')) }}                        
                                                                        {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
                                                                         
                                                                        <div class="form-group">
                                                                            <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                                                                            <div class="col-xs-10">
                                                                                <input type="file" id="photoFile" name='myfile' class='form-control'> 
                                                                            </div>
                                                                        </div>  
                                                                        <div class="form-group">
                                                                            <label for="inputPassword" class="control-label col-xs-2">Target</label>

                                                                            <div class="col-sm-10">
                                                                                {{ Form::text('target', $ads->target, array('id' => 'target','class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div>                                                                               
                                                                        
                                                                        {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                                                                                                                
                                                                        <div class="form-group">
                                                                            <div class="col-sm-10">
                                                                                {{ Form::hidden('hash', "", array('id' => "editAdsSectionHash",'class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setAdsSection" id="editAdsSection">Submit</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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