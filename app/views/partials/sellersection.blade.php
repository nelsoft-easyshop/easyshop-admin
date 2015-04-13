                        <form id='' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                            <legend>        
                                <h4 class="tbl-title">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Change Seller Slug
                                </h4>
                            </legend>                         
                            {{ Form::hidden('action', "slug", array('id' => 'action','class' => 'form-control')) }}                        
                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                          
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                <div class="col-xs-10">
                                    <input type="text" id="slug" name='slug' class='form-control' value="{{{$sellerSection->sellerSlug}}}"> 
                                </div>
                            </div>                                                                                 
                                                                                                   
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSellerHead"  id="changeSellerSlug">Change Seller Slug</a>
                                </div>
                            </div>
                        </form>

                        <form id='changeSellerBannerForm' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                            <legend>        
                                <h4 class="tbl-title">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Change Seller Banner
                                </h4>
                            </legend>                         
                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
     
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                                <div class="col-xs-10">
                                    <input type="file" id="sellerFile" name='myfile' class='form-control'> 
                                </div>
                            </div>            
                            {{ Form::hidden('action', "banner", array('id' => 'action','class' => 'form-control')) }}                        
                            {{ Form::hidden('hash', "", array('id' => "hashChangeSellerBanner",'class' => 'form-control')) }}                        
                                                                                                   
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSellerHead" id="changeSellerBannerSubmit">Change Seller Banner</a>
                                </div>
                            </div>
                            <center>
                                <div class='well' style="height:auto;max-width: 600px;">
                                    <div style=" height: 220px;max-width: 500px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                        <img src="{{$assetLink}}{{$sellerSection->sellerBanner}}" class="img-responsive" data-div="" style="border: black 1px solid;height: auto; max-height: 200px;"/>
                                    </div>
                                </div>
                            </center>
                            
                        </form>

                        <form id='changeSellerLogoForm' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                            <legend>        
                                <h4 class="tbl-title">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Change Seller Logo
                                </h4>
                            </legend>                         
                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
     
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                                <div class="col-xs-10">
                                    <input type="file" id="sellerFile" name='myfile' class='form-control'> 
                                </div>
                            </div>                                                                                 
                            {{ Form::hidden('action', "logo", array('id' => 'action','class' => 'form-control')) }}                        
                            {{ Form::hidden('hash', "", array('id' => "hashChangeSellerLogo",'class' => 'form-control')) }}                        
                                                                                                   
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <a href="javascript:void(0);"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSellerHead" id="changeSellerLogoSubmit">Change Seller Logo</a>
                                    <a href="javascript:void(0);"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSellerHead" id="useDefaultSellerLogoSubmit">Use Default Seller Logo</a>
                                </div>
                            </div>
                            <center>
                                <div class='well' style="height:auto;max-width: 600px;">
                                    <div style=" height: 220px;max-width: 500px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                        @if (trim($sellerSection->sellerLogo) === "")
                                            <img src="{{$assetLink}}/assets/images/default-image-set.png" class="img-responsive seller-logo-default" data-div="" style="border: black 1px solid;height: auto; max-height: 200px;"/>
                                            <img src="{{$assetLink}}{{$sellerSection->sellerLogo}}" class="img-responsive" style="display:none" data-div="" style="border: black 1px solid;height: auto; max-height: 200px;"/>
                                        @else
                                            <img src="{{$assetLink}}/assets/images/default-image-set.png" class="img-responsive seller-logo-actual" style="display:none" data-div="" style="border: black 1px solid;height: auto; max-height: 200px;"/>
                                            <img src="{{$assetLink}}{{$sellerSection->sellerLogo}}" class="img-responsive" data-div="" style="border: black 1px solid;height: auto; max-height: 200px;"/>
                                        @endif
                                    </div>
                                </div>
                            </center>                            
                        </form>
