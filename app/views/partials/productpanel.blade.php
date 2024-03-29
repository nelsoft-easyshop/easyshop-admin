                                    <span style="display:none;">{{$productPanelindex = 0}}</span>
                                    <span style="display:none;">{{$productPanelCount = 1}}</span>
                                    <div class="col-lg-15" style='text-align:center;'>
                                        @foreach($productList as $productPanel)
                                            <div style="position:relative;display:inline-block;">
                                                <div class='well' style="height:auto;">
                                                    <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                        <img src="{{$assetLink}}{{ltrim($productPanel->imageDirectory, '.')}}categoryview/{{ $productPanel->imageFile }}" class="img-responsive" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                    </div>

                                                    <a href="#productPanel{{$productPanelindex}}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                    <a class="btn btn-default" 
                                                        id="removeProductPanel" 
                                                        data-index="{{$productPanelindex}}" 
                                                        data-nodename="productPanel" 
                                                        style="position:absolute;top:2px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                     ><font color='red'><b>X</b></font></a>
                                                 </div>
                                                 <span class="productPanelCount" style="display:none;">{{$productPanelCount}}</span>
                                                <!--Start Edit Slide Modal -->
                                                    <div class="modal fade user_modal" id="productPanel{{$productPanelindex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Product Panel</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal">                                        
                                                                        <div class="form-group">
                                                                            <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                                                            <div class="col-xs-10">
                                                                                <input type="text" id="value" name='value' value="{{$productPanel->slug}}" class='form-control'> 
                                                                            </div>
                                                                        </div>    
                                                                        {{ Form::hidden('index', $productPanelindex, array('id' => 'index','class' => 'form-control')) }}                                                                                              

                                                                        <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setSellerProductPanel" id="editProductPanel">Edit Product Panel</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!--End Edit Slide Modal -->

                                            <span style="display:none;">{{$productPanelindex++}}</span>  
                                            <span style="display:none;">{{$productPanelCount++}}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    