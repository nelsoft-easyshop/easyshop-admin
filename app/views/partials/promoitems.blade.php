    <script type="text/javascript">
        $(document).ready(function(){

            $("#loading").modal('hide');
            $("#success").modal('show');
        });

    </script>    
        <div class="tab-pane fade active in" id="addfeedPromoItems">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                            Add Promo Items
                        </a>
                    </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form method="post" action="$contentCmsLink/addfeedPromoItems" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                <fieldset>
                                    <!-- Form Name -->
                                    <div class="form-group ">
                                        <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                        <div class="col-sm-10">
                                            {{ Form::text('promoItem', "" ,array('id' => 'promoItem','class' => 'form-control')) }}
                                            {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                            {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                            {{ Form::hidden('hash', "", array('id' => 'hash')) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div style='text-align:center;padding-top:10px;'>
                                        <br/>
                                        <a href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/addfeedPromoItems" id="addPromoItemBtn"
                                            >Submit</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                                Manage Promo Items
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class='row'>
                                @foreach($feedPromoItems as $products)
                                    <div class='col-md-4'>
                                        <div class='well' >
                                            <a href="#" id="moveDownPromoItems"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$promoItemsCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedPromoItems"
                                            >
                                                <span class="glyphicon glyphicon-chevron-right pull-right" style='font-size:16px;'></span>
                                            </a>

                                            <a href='#' id="moveUpPromoItems"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$promoItemsCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedPromoItems"
                                            >
                                                <span class="glyphicon glyphicon-chevron-left pull-left" style='font-size:16px;'></span>
                                            </a>
                                           
                                            <center>
                                                <span>{{$products->slug}}</span><br/><br/>
                                                <a href='#modalPromo{{$indexForEach}}' data-toggle="modal">
                                                    <span class="glyphicon glyphicon-edit" style='font-size:16px;'></span>
                                                </a>
                                            </center>
                                        </div>                                            
                                    </div>

                                    <div class="modal fade" id="modalPromo{{$indexForEach}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h4>Edit Promo Item</h4>
                                                    </div>
                                                <div class="modal-body">
                                                    <form method="post" action="$contentCmsLink/addfeedPromoItems" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                                        <fieldset>
                                                            <!-- Form Name -->
                                                            <div class="form-group ">
                                                                <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                                                <div class="col-sm-10">
                                                                    {{ Form::text('promoItem', "$products->slug" ,array('id' => 'promoItem','class' => 'form-control')) }}
                                                                    {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                                                    {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div style='text-align:center;padding-top:10px;'>
                                                                <br/>
                                                                <a href="#" data-index="{{$indexForEach}}" data-order="{{$indexForEach}}" data-dismiss = "modal" class="btn btn-primary"  data-url = "{{ $contentCmsLink }}/setfeedPromoItems" id="submitPromoItemBtn"
                                                                    >Submit</a>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                <span style="display:none;">{{ $indexForEach++ }}</span>
                                @endforeach
                                <span style="display:none;">{{ $indexForEach=0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>