                    <table class="table table-striped table-hover tbl-my-style" id="addBrandsTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Product Slug</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$brandsCount=1}}</span>                               
                        <span style="display:none;">{{$brandsIndex=0}}</span>                             
                        @foreach($brandsLists as $brands)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editBrands" id="editTopSellersBtn" 
                                                data-toggle="modal" data-target="#editBrandsModal"
                                                data='{"url":"{{$newHomeCmsLink}}/setBrands","index":"{{$brandsIndex}}","value":"{{$brands->name}}","id_brand":"{{$brands->id_brand}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeBrands"
                                                    data-nodename="brands" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$brandsIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$brands->name}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="brandsCount">{{$brandsCount++}}</span>                               
                        <span style="display:none;">{{$brandsIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                    