                        <table class="table table-striped table-hover tbl-my-style"  id="tblSubcategories_{{{$index}}}">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Value</th>


                            </tr>
                            </thead>
                            <tbody id="tbody_boxContent">
                            <span style="display:none;">{{{ $subIndex = 0 }}}</span>
                                @foreach($subCategoryNavigation as $subCategories)
                                    <tr id="row_{{$index}}_{{$subIndex}}">
                                        <td>
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger edit_btn" id="data_{{$index}}_{{$subIndex}}" 
                                                        data-toggle="modal" data-target="#myModal"
                                                        data='{"url":"{{{$newHomeCmsLink}}}/setSubCategories","index":"{{{  $index }}}","subIndex":"{{{ $subIndex }}}","value":"{{{ $subCategories }}}" } '
                                                        >
                                                        <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                                    </button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn edit_btn removeButton" id="data_{{$index}}_{{$subIndex}}" 
                                                        data='{"url":"{{{$newHomeCmsLink}}}/removeContent","index":"{{{  $index }}}","subIndex":"{{{ $subIndex }}}","value":"{{{ $subCategories }}}" } '
                                                        >
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </button>
                                                </div>                                                    
                                            </div>
                                        </td>
                                        <td id="value_{{$index}}_{{$subIndex}}" class="subCategoryTD">{{{ $subCategories }}}</td>
                                        <span style="display:none;"></span>                            
                                        <input type="hidden" class="boxContentCount_" value="">
                                    </tr>
                                    <span style="display:none;">{{{ $subIndex ++ }}}</span>
                                @endforeach

                            </tbody>
                        </table>

                        