                    <table class="table table-striped table-hover tbl-my-style" id="addTopProductsTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Product Slug</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$topProductsCount=1}}</span>                               
                        <span style="display:none;">{{$topProductsIndex=0}}</span>                             
                        @foreach($topProducts[0] as $products)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editTopProducts" id="editTopProductsBtn" 
                                                data-toggle="modal" data-target="#editTopProducts"
                                                data='{"url":"{{$newHomeCmsLink}}/setTopProducts","index":"{{$topProductsIndex}}","value":"{{$products}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeTopProducts"
                                                    data-nodename="topProducts" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$topProductsIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$products}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="topProductsCount">{{$topProductsCount++}}</span>                               
                        <span style="display:none;">{{$topProductsIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                    