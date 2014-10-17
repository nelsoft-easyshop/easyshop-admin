                     <table class="table table-striped table-hover tbl-my-style" id="otherCategoriesTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Categories</th>

                        <!-- HERE -->
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$otherCategoriesCount=1}}</span>                               
                        <span style="display:none;">{{$otherCategoriesIndex=0}}</span>                               
                        @foreach($otherCategories[0]->categorySlug as $others)
                            <tr id="row_">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editOtherCategory" id="editOtherCategoryBtn" 
                                                data-toggle="modal" data-target="#editOtherCategory"
                                                data='{"url":"{{$newHomeCmsLink}}/setOtherCategories","index":"{{$otherCategoriesIndex}}","value":"{{$others}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeOtherCategory"
                                                    data-nodename="otherCategories" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$otherCategoriesIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$others}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="otherCategoriesCount">{{$otherCategoriesCount++}}</span>                               
                        <span style="display:none;">{{$otherCategoriesIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                    