
        <div class="tab-pane fade active in" id="addFeaturedProduct">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Add Featured Product
                        </a>
                    </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form method="post" action="$contentCmsLink/addfeedFeaturedProduct" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                <fieldset>
                                    <!-- Form Name -->
                                    <div class="form-group ">
                                        <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                        <div class="col-sm-10">
                                            {{ Form::text('featuredProduct', "" ,array('id' => 'featuredProduct','class' => 'form-control')) }}
                                            {{ Form::hidden('password', "$adminObject->password", array('id' => 'adminPassword')) }}
                                            {{ Form::hidden('userId', "$adminObject->id_admin_member", array('id' => 'userId')) }}
                                            {{ Form::hidden('hash', "", array('id' => 'hash')) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div style='text-align:center;padding-top:10px;'>
                                        <br/>
                                        <a href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/addfeedFeaturedProduct" id="addFeaturedProductBtn"
                                            >Submit</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Manage Featured Product
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class='row'>
                                @foreach($feedFeaturedProduct as $products)
                                    <div class='col-md-4'>
                                        <div class='well' >
                                            <a id="moveDownFeaturedProduct"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$adminObject->id_admin_member}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$featuredProductCount}}" 
                                                data-password="{{$adminObject->password}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedFeaturedProduct"
                                            >
                                                <span class="glyphicon glyphicon-chevron-right pull-right" style='font-size:16px;'></span>
                                            </a>

                                            <a id="moveUpFeaturedProduct"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$adminObject->id_admin_member}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$featuredProductCount}}" 
                                                data-password="{{$adminObject->password}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedFeaturedProduct"
                                            >
                                                <span class="glyphicon glyphicon-chevron-left pull-left" style='font-size:16px;'></span>
                                            </a>
                                           
                                            <center>
                                                <span>{{$products->slug}}</span><br/><br/>
                                                <a href='#modal{{$indexForEach}}' data-toggle="modal">
                                                    <span class="glyphicon glyphicon-edit" style='font-size:16px;'></span>
                                                </a>
                                                <a 
                                                    id="productslide" 
                                                    data-index="{{$indexForEach}}"  
                                                    data-nodename="//feedFeaturedProduct" 
                                                    data-userid="{{$adminObject->id_admin_member}}"                                                
                                                    data-password="{{$adminObject->password}}"
                                                    data-url = "{{ $contentCmsLink }}/removeContent"
                                                 >
                                                    <span class="glyphicon glyphicon-remove" style='font-size:16px;'></span>

                                                </a>                                                  
                                            </center>
                                        </div>                                            
                                    </div>

                                    <div class="modal fade" id="modal{{$indexForEach}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h4>Edit Featured Product</h4>
                                                    </div>
                                                <div class="modal-body">
                                                    <form method="post" action="$contentCmsLink/addfeedFeaturedProduct" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                                        <fieldset>
                                                            <!-- Form Name -->
                                                            <div class="form-group ">
                                                                <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                                                <div class="col-sm-10">
                                                                    {{ Form::text('featuredProduct', "$products->slug" ,array('id' => 'featuredProduct','class' => 'form-control')) }}
                                                                    {{ Form::hidden('password', "$adminObject->password", array('id' => 'adminPassword')) }}
                                                                    {{ Form::hidden('userId', "$adminObject->id_admin_member", array('id' => 'userId')) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div style='text-align:center;padding-top:10px;'>
                                                                <br/>
                                                                <a href="#" data-index="{{$indexForEach}}" data-order="{{$indexForEach}}" data-dismiss = "modal" class="btn btn-primary"  data-url = "{{ $contentCmsLink }}/setfeedFeaturedProduct" id="submitFeaturedProductBtn"
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>