                    <table class="table table-striped table-hover tbl-my-style" id="addTopSellersTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Product Slug</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$topSellersCount=1}}</span>                               
                        <span style="display:none;">{{$topSellersIndex=0}}</span>                             
                        @foreach($topSellers[0] as $sellers)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editTopSellers" id="editTopSellersBtn" 
                                                data-toggle="modal" data-target="#editTopSellers"
                                                data='{"url":"{{$newHomeCmsLink}}/setTopSellers","index":"{{$topSellersIndex}}","value":"{{$sellers}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeTopSellers"
                                                    data-nodename="topSellers" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$topSellersIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$sellers}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="topSellersCount">{{$topSellersCount++}}</span>                               
                        <span style="display:none;">{{$topSellersIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>