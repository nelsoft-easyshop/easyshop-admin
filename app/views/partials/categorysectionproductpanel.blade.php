<div class="col-lg-15" style='text-align:center;' id="categorySectionProductPanel_{{$categorySectionIndex}}">

                                                <span style="display:none;">{{$subCategorySectionIndex = 0}}</span>                                                
                                                <span style="display:none;">{{$categoryProductPanelCount = 1}}</span>                                                
                                                @foreach($categoryProductPanelList[$categorySectionIndex] as $categorySectionProducts)
                                                    <div style="position:relative;display:inline-block;">
                                                        <div class='well' style="height:210px;">
                                                            <p>
                                                                <img src="{{$easyShopLink}}{{ltrim($categorySectionProducts->product_image_path, '.')}}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive'/>
                                                            </p>
                                                            <a href="#categoryProductPanel_{{$categorySectionIndex}}_{{$subCategorySectionIndex}}" data-toggle="modal" style="position:absolute;top:180px;left:135px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                            <a class="btn btn-default" 
                                                                id="removeCategoryProductPanel" 
                                                                data-index="{{$categorySectionIndex}}" 
                                                                data-subindex="{{$subCategorySectionIndex}}" 
                                                                data-nodename="categoryProductPanel" 
                                                                style="position:absolute;top:2px;left:5px;"
                                                                data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                             ><font color='red'><b>X</b></font></a>

                                                            <a 
                                                                id="moveupCategoryProductPanel" 
                                                                data-action="up" 
                                                                data-index="{{$categorySectionIndex}}" 
                                                                data-order="{{$subCategorySectionIndex}}" 
                                                                data-subindex="{{$subCategorySectionIndex}}" 
                                                                style="position:absolute;top:180px;left:5px;"
                                                                data-url = "{{{$newHomeCmsLink}}}/setPositionCategoryProductPanel"
                                                             ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                                             <a  
                                                                id="movedownCategoryProductPanel" 
                                                                data-action="down" 
                                                                data-index="{{$categorySectionIndex}}" 
                                                                data-order="{{$subCategorySectionIndex}}" 
                                                                data-subindex="{{$subCategorySectionIndex}}" 
                                                                style="position:absolute;top:180px;right:5px;"
                                                                data-url = "{{{$newHomeCmsLink}}}/setPositionCategoryProductPanel"
                                                             ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
                                                            <span class="categoryProductPanelCount" style="display:none;">{{$categoryProductPanelCount}}</span>



                                                        <!--Start Edit Slide Modal -->
                                                            <div class="modal fade user_modal" id="categoryProductPanel_{{$categorySectionIndex}}_{{$subCategorySectionIndex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                            <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Category Product Panel</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal">                                        
                                                                                <div class="form-group">
                                                                                    <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                                                                    <div class="col-xs-10">
                                                                                        <input type="text" id="value" name='value' value="{{$categorySectionProducts->slug}}" class='form-control'> 
                                                                                    </div>
                                                                                </div>    
                                                                              
                                                                                {{ Form::hidden('index', $categorySectionIndex, array('id' => 'index','class' => 'form-control')) }}                                                                                              
                                                                                {{ Form::hidden('subindex', $subCategorySectionIndex, array('id' => 'subindex','class' => 'form-control')) }}                                                                                              

                                                                                <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setCategoryProductPanel" id="editCategoryProductPanel">Edit Product Panel</button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!--End Edit Slide Modal -->                                                            




                                                        </div>
                                                    </div>
                                                <span style="display:none;"  class="categoryProductPanelCount_{{$categorySectionIndex}}">{{$categoryProductPanelCount++}}</span>                                                                                                    
                                                <span style="display:none;">{{$subCategorySectionIndex++}}</span>                                                
                                                @endforeach
                                            </div>