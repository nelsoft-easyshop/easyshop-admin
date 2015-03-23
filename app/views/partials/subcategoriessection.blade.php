                                   
                                <div class="panel-group" id="accordion_{{{ $categorySectionIndex }}}">
                                <span style="display:none;">{{{ $subCategorySection = 0 }}}</span>
                                <span style="display:none;">{{$subCategorySectionIndex = 0}}</span>                                  
                                                @foreach($categoryPanel as $subCategoriesSection)
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#subAccordion_{{$categorySectionIndex}}_{{$subCategorySection}}">
                                                                    {{{ $subCategoriesSection->text }}}
                                                                </a>                                                                
                                                                <span class="glyphicon glyphicon-remove pull-right removeCategorySection" 
                                                                      id="data_{{$categorySectionIndex}}_{{$subCategorySection}}" 
                                                                      style="cursor:pointer;" 
                                                                      data-nodename="categorySection" 
                                                                      data-url="{{$newHomeCmsLink}}/removeContent" 
                                                                      data-index = "{{{  $categorySectionIndex }}}" 
                                                                      data-subindex = "{{{ $subCategorySection }}}"
                                                                >
                                                                </span>                                                                
                                                            </h4>
                                                        </div>

                                                        <!-- edit here -->
                                                        <div id="subAccordion_{{$categorySectionIndex}}_{{$subCategorySection}}" class="panel-body collapse">
                                                            <div class="panel-inner">

                                                                <form id='changeProductPanel' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                                                                    <legend>        
                                                                        <h4 class="tbl-title">
                                                                            <span class="glyphicon glyphicon-list-alt"></span>
                                                                            Add Category Product Panel
                                                                        </h4>
                                                                    </legend>                         
                                             
                                                                    <div class="form-group">
                                                                        <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                                                        <div class="col-xs-10">
                                                                            <input type="text" id="value" name='value' class='form-control'> 
                                                                        </div>
                                                                    </div>                                                                                 
                                                                                                                                           
                                                                    <div class="form-group">
                                                                        <div class="col-xs-offset-2 col-xs-10">
                                                                            <a1 href="#"  
                                                                                class="btn btn-primary text-center" 
                                                                                data-url = "{{{$newHomeCmsLink}}}/addCategoryProductPanel" 
                                                                                data-index="{{$categorySectionIndex}}" 
                                                                                data-subindex="{{$subCategorySection}}" 
                                                                                data-subpanelindex="{{$newCategorySection}}" 
                                                                                id="addCategoryProductPanel">Add Category Product Panel</a>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <div class="col-lg-15" style='text-align:center;' id="categorySectionProductPanel_{{$categorySectionIndex}}_{{$subCategorySection}}">
                                                                    <span style="display:none;">{{{ $subPanelIndex = 0 }}}</span>
                                                                    <span style="display:none;">{{$categoryProductPanelCount = 1}}</span>                                                
                                                                    @foreach($categoryProductPanelList[$newCategorySection] as $categorySectionProducts)
                                                                        <div style="position:relative;display:inline-block;">
                                                                            <div class='well' style="height:auto;">
                                                                                <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                                                    <img src="{{$assetLink}}{{ltrim($categorySectionProducts->product_image_path, '.')}}"class="img-responsive" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                                                </div>
                                                                                <a href="#categoryProductPanel_{{$categorySectionIndex}}_{{$subCategorySectionIndex}}_{{$subPanelIndex}}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                                                <a class="btn btn-default" 
                                                                                    id="removeCategoryProductPanel" 
                                                                                    data-index="{{$categorySectionIndex}}" 
                                                                                    data-subindex="{{$subCategorySectionIndex}}" 
                                                                                    data-nodename="categoryProductPanel" 
                                                                                    data-subpanelindex="{{$subPanelIndex}}" 
                                                                                    data-newcategorysection="{{$newCategorySection}}" 
                                                                                    style="position:absolute;top:2px;left:5px;"
                                                                                    data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                                                 ><font color='red'><b>X</b></font></a>

                                                                                <a 
                                                                                    id="moveupCategoryProductPanel" 
                                                                                    data-action="up" 
                                                                                    data-index="{{$categorySectionIndex}}" 
                                                                                    data-subindex="{{$subCategorySectionIndex}}"
                                                                                    data-order="{{$subPanelIndex}}" 
                                                                                    data-subpanelindex="{{$subPanelIndex}}"
                                                                                    data-newcategorysection="{{$newCategorySection}}"                                                                                     
                                                                                    style="position:absolute;top:235px;left:5px;"
                                                                                    data-url = "{{{$newHomeCmsLink}}}/setPositionCategoryProductPanel"
                                                                                 ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                                                                <a  
                                                                                    id="movedownCategoryProductPanel" 
                                                                                    data-action="down" 
                                                                                    data-index="{{$categorySectionIndex}}" 
                                                                                    data-subindex="{{$subCategorySectionIndex}}"
                                                                                    data-order="{{$subPanelIndex}}" 
                                                                                    data-subpanelindex="{{$subPanelIndex}}" 
                                                                                    data-newcategorysection="{{$newCategorySection}}"                                                                                     
                                                                                    style="position:absolute;top:235px;right:5px;"
                                                                                    data-url = "{{{$newHomeCmsLink}}}/setPositionCategoryProductPanel"
                                                                                ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
                                                                                <span class="categoryProductPanelCount" style="display:none;">{{$categoryProductPanelCount}}</span>

                                                                            <!--Start Edit Slide Modal -->
                                                                                <div class="modal fade user_modal" id="categoryProductPanel_{{$categorySectionIndex}}_{{$subCategorySectionIndex}}_{{$subPanelIndex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                                                  
                                                                                                    {{ Form::text('index', $categorySectionIndex, array('id' => 'index','class' => 'form-control')) }}                                                                                              
                                                                                                    {{ Form::text('subindex', $subCategorySectionIndex, array('id' => 'subindex','class' => 'form-control')) }}                                                                                              
                                                                                                    {{ Form::text('productSlugIndex', $subPanelIndex, array('id' => 'subPanelIndex','class' => 'form-control')) }}                                                                                              
                                                                                                    {{ Form::text('newCategorySection', $newCategorySection, array('id' => 'newCategorySection','class' => 'form-control')) }}                                                                                              

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
                                                                    <span style="display:none;" class="categoryProductPanelCount_{{$categorySectionIndex}}">{{$categoryProductPanelCount++}}</span>                                                                                                    
                                                                    
                                                                    <span style="display:none;">{{$subPanelIndex++}}</span>                                                  
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <span style="display:none;" class="subCategorySectionCount_{{$categorySectionIndex}}">{{{ $subCategorySection++ }}}</span>
                                                    <span style="display:none;">{{$newCategorySection++}}</span>
                                                    <span style="display:none;">{{$subCategorySectionIndex++}}</span>  
                                                    </div>
                                            @endforeach
                                            </div>