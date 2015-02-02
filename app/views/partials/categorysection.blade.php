
                    <form id='changeProductPanel' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Add Category Section
                            </h4>
                        </legend>                         
 
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                            <div class="col-xs-10">
                                <select name="c_stateregion" id="addCategorySectionValue"  class="form-control">
                                    @foreach($categoryLists as $categories)
                                        @if($categories["name"] !== "PARENT")
                                            <option value="{{{$categories['slug']}}}">{{{$categories["name"]}}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>                                                                                 
                                                                                               
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addCategorySection" id="addCategorySectionProductPanel">Add Product Panel</a>
                            </div>
                        </div>
                    <span style="display:none;">{{$categorySectionIndex = 0}}</span>
                    <span style="display:none;">{{$categorySectionCount = 1}}</span>                    
                    </form>   
                    <div class="panel-group" id="accordion">
                        @foreach($categorySection as $categoryPanel)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_category_{{$categorySectionIndex}}">{{ucwords(str_replace("-"," ",$categoryPanel->categorySlug))}}</a>
                                            <span class="glyphicon glyphicon-remove pull-right" id="removeCategorySection" data-nodename="categorySectionPanel" data-index="{{$categorySectionIndex}}" data-url="{{$newHomeCmsLink}}/removeContent" style="cursor:pointer;"></span>
                                        </h4>
                                    </div>
                                    
                                    <div id="collapse_category_{{$categorySectionIndex}}" class="panel-collapse collapse">
                                        <div class="panel-body" id="productPanelDivsss">

                                            <!-- Start Add Sub Category Section -->

                                            <form id='left' target="test"  class="form-horizontal">            
                                                <legend>        
                                                    <h4 class="tbl-title">
                                                        <span class="glyphicon glyphicon-list-alt"></span>
                                                        Add Sub Category
                                                    </h4>
                                                </legend>     

                                                {{ Form::hidden('index', "$categorySectionIndex", array('id' => 'index','class' => 'form-control')) }}                                                        
                                                <div class="form-group">
                                                    <label for="inputPassword" class="control-label col-xs-2">Sub Category Text</label>
                                                    <div class="col-xs-10">
                                                        <input type="text" id="subCategoryText" name='subCategoryText' class='form-control'> 
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="inputPassword" class="control-label col-xs-2">Sub Category Target</label>
                                                    <div class="col-xs-10">
                                                        <input type="text" id="subCategorySectionTarget" name='subCategorySectionTarget' class='form-control'> 
                                                    </div>
                                                </div>                                                                                                        
                                                <div class="form-group">
                                                    <div class="col-xs-offset-2 col-xs-10">
                                                        <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addSubCategorySection" id="addSubCategorySection">Add Sub Category</a>
                                                    </div>
                                                </div>                                      
                                            </form> 

                                            <!-- End Add Sub Category Section -->


                                            <!-- Start Manage Sub Category Section -->
                                             <table class="table table-striped table-hover tbl-my-style"  id="subCategoriesSection_{{{$categorySectionIndex}}}">
                                                <thead>
                                                <tr>
                                                    <th>/</th>
                                                    <th>Text</th>
                                                    <th>Target</th>

                                                <!-- HERE -->
                                                </tr>
                                                </thead>
                                                <tbody id="tbody_boxContent">
                                                <span style="display:none;">{{{ $subCategorySection = 0 }}}</span>
                                                    @foreach($categoryPanel->sub as $subCategoriesSection)
                                                        <tr id="row_{{$categorySectionIndex}}_{{$subCategorySection}}">
                                                            <td>
                                                                <div class="btn-toolbar" role="toolbar">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-danger editCategorySection" id="data_{{$categorySectionIndex}}_{{$subCategorySection}}" 
                                                                            data-toggle="modal" data-target="#modalForCategorySection"
                                                                            data='{"url":"{{{$newHomeCmsLink}}}/setSubCategoriesSection","categorySectionIndex":"{{{  $categorySectionIndex }}}","subCategorySectionIndex":"{{{ $subCategorySection }}}","value":"{{{ $subCategoriesSection->text }}}", "target":"{{{ $subCategoriesSection->target }}}" } '
                                                                            >
                                                                            <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn edit_btn removeCategorySection" id="data_{{$categorySectionIndex}}_{{$subCategorySection}}" 
                                                                                data-nodename="categorySection" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{{  $categorySectionIndex }}}" data-subindex = "{{{ $subCategorySection }}}"
                                                                            >
                                                                            <span class="glyphicon glyphicon-remove"></span>
                                                                        </button>
                                                                    </div>                                                    
                                                                </div>
                                                            </td>
                                                            <td id="value_{{$categorySectionIndex}}_{{$subCategorySection}}" class="subCategoryTD">{{{ $subCategoriesSection->text }}}</td>
                                                            <td id="value_{{$categorySectionIndex}}_{{$subCategorySection}}" class="subCategoryTD">{{{ $subCategoriesSection->target }}}</td>
                                                            <span style="display:none;"></span>                            
                                                            <input type="hidden" class="boxContentCount_" value="">
                                                        </tr>
                                                        <span style="display:none;">{{{ $subCategorySection ++ }}}</span>
                                                    @endforeach

                                                </tbody> 
                                            </table>
   

                                            <!-- End Manage Sub Category Section -->


                                            <!-- Start Product Panel Category Section -->

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
                                                        <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addCategoryProductPanel" data-index="{{$categorySectionIndex}}" id="addCategoryProductPanel">Add Category Product Panel</a>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="col-lg-15" style='text-align:center;' id="categorySectionProductPanel_{{$categorySectionIndex}}">

                                                <span style="display:none;">{{$subCategorySectionIndex = 0}}</span>                                                
                                                <span style="display:none;">{{$categoryProductPanelCount = 1}}</span>                                                
                                                @foreach($categoryProductPanelList[$categorySectionIndex] as $categorySectionProducts)
                                                    <div style="position:relative;display:inline-block;">
                                                        <div class='well' style="height:210px;">
                                                            <p>
                                                                <img src="{{$assetLink}}{{ltrim($categorySectionProducts->product_image_path, '.')}}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive'/>
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
                                                <span style="display:none;">{{$categoryProductPanelCount++}}</span>                                                                                                    
                                                <span style="display:none;">{{$subCategorySectionIndex++}}</span>                                                
                                                @endforeach
                                            </div>

                                            <!-- End Product Panel Category Section -->


                                        </div>
                                    </div>
                                    <span style="display:none;">{{$categorySectionIndex++}}</span>    
                                    <span style="display:none;" class='categorySectionCount'>{{$categorySectionCount++}}</span>                                                           
                                </div>
                        @endforeach
                    </div>

                    
