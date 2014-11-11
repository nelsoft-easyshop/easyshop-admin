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
                                                    @foreach($categoryPanel as $subCategoriesSection)
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
                                                        <span style="display:none;" class="subCategorySectionCount_{{$categorySectionIndex}}">{{{ $subCategorySection++ }}}</span>
                                                    @endforeach

                                                </tbody> 
                                            </table>
                                            