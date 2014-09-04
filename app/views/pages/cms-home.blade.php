  @extends('layouts.default')

@section('description', 'Content Manager - Home')
@section('keywords', '')
@section('title', 'Home CMS | Easyshop Admin')
@section('header_tagline', 'Content Manager - Home')


@section('page_header')
    @include('includes.header')
@stop

@section('content')


    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/homecms.css') }}}" rel="stylesheet"  media="screen"/>

  <div class="row">

    <section id="tabs">
          <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#setText" data-toggle="tab">Manage Banner Text</a></li>
              <li class=""><a href="#productSlideTitle" data-toggle="tab">Manage Product Slide Title</a></li>
              <li class=""><a href="#productSideBanner" data-toggle="tab">Manage Product Side Banner </a></li>
              <li class=""><a href="#productSlide" data-toggle="tab">Manage Product Slide</a></li>
              <li class=""><a href="#mainSlide" data-toggle="tab">Manage Main Slide</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Section Heads<b class="caret"></b></a>

                 	<ul class="dropdown-menu">
                      @foreach($sectionHeads as $heads)
                         <li><a href="#{{ $heads->value }}" data-toggle="tab">{{ $heads->value }}</a></li>
                      @endforeach
                       
                        <li class='divider'></li>
                        <li><a href='#addSectionMainPanel' data-toggle ="tab">Add Section Main Panel</a></li>
                        <li><a href='#AddSectionProduct' data-toggle ="tab">Add Section Product</a></li>
                        <li><a href='#nodeTypes' data-toggle ="tab">Add Node Type</a></li>
                 	</ul>

              </li>
          </ul>
    </section>



    <div id="myTabContent" class="tab-content">
		@foreach($sectionHeads as $section)
					<span style='display:none;'> {{ $collapse++; }}</span>
					<div class="tab-pane fade" id="{{$section->value}}">
						<div class="panel-group" id="accordion">
							<span style='display:none;'> {{ $sectionId++ }}</span>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
											Set Section Head
										</a>
									</h4>
								</div>
								<div id="collapse{{$collapse}}" class="panel-collapse collapse" >
									<div class="panel-body">
										<form class="form-horizontal">
											<div class="form-group">
												<label for="inputEmail" class="control-label col-xs-2">Type</label>
													<div class="col-xs-10">
														<input type="text" id="type" class="form-control"  placeholder="Type" value="{{ $section->type }}">
													</div>
											</div>
											<div class="form-group">
												<label for="inputPassword" class="control-label col-xs-2">Value</label>
												<div class="col-xs-10">
													<input type="text" id="value" class="form-control"  placeholder="Value" value="{{ $section->value }}">
												</div>
											</div>
											<div class="form-group">
												<label for="inputPassword" class="control-label col-xs-2">Css Class</label>
													<div class="col-xs-10">
														<input type="text" id="cssclass" class="form-control"  placeholder="CSS CLass" value="{{ $section->css_class }}">
													</div>
											</div>
											<div class="form-group">
												<label for="inputPassword" class="control-label col-xs-2">Layout</label>
												<div class="col-xs-10">
													<input type="text" id="layout" class="form-control"  placeholder="Layout" value="{{ $section->layout }}">
												</div>
											</div>
											<div class="form-group">
												<label for="inputPassword" class="control-label col-xs-2">Title</label>
												<div class="col-xs-10">
													<input type="text" id="title" class="form-control"  placeholder="Layout" value="{{ $section->title }}">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-offset-2 col-xs-10">
													<a href="#"  class="btn btn-default text-center" id="btnSectionHead" data-url = "{{ $homeCmsLink }}/setsectionhead" data-password = "{{ $adminPassword }}" data-index="{{$sectionId}}" data-userid="{{$userId}}">Submit</a>
												</div>
											</div>
										</form>
									</div>
								</div> 
							</div>

					<span style='display:none;'> {{ $collapse++; }}</span>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">Set Section Main Panel</a>
							</h4>
						</div>
						<div id="collapse{{$collapse}}" class="panel-collapse collapse ">
							<div class="panel-body">	 
								<span style='display:none;'> {{ $panelMainId = 0 }}</span>
								@foreach($section->product_panel_main as $panelMain)
									<span style='display:none;'>{{ $panelMainId }}</span>
									<form class="form-horizontal">
										<div class="form-group">
											<label for="inputEmail" class="control-label col-xs-2">Type of Main Panel</label>
											  	<div class="col-xs-10">
													<div class="btn-group">
														<button data-toggle="dropdown" id="mybutton{{ $panelMainId }}" class="btn btn-default dropdown-toggle"><span id="btntext{{$panelMainId}}">Product</span><span class="carete"></span></button>
														<ul class="dropdown-menu">
															@foreach($nodeTypes as $types)
															  <li>&nbsp;&nbsp;&nbsp;<span style='cursor:pointer;' data-index='{{ $panelMainId }}' class='{{$types->value}}'>{{$types->value}}</span ></li>
															@endforeach
														</ul>
													</div>				  
											 	 </div>
										</div>
										<div class="form-group">
											<label for="inputPassword" class="control-label col-xs-2">Type</label>
											<div class="col-xs-10">
												<input type="text" id="type" class="form-control" readonly='readonly' placeholder="Value" value="{{ $panelMain->type }}">
											</div>
										</div>
										 <div class="form-group">
											<label for="inputPassword" class="control-label col-xs-2">Value</label>
											<div class="col-xs-10">
												<input type="text" id="value" class="form-control"  placeholder="Value" value="{{ $panelMain->value }}">
											</div>
										</div>
										@if ($panelMain->type == "Image" || $panelMain->type == "image")
											<div id='imagetype{{$panelMainId}}' style="display:block;">
										@else
											<div id='imagetype{{$panelMainId}}' style="display:none;">
										@endif
											<div class="form-group">
												<label for="inputPassword" class="control-label col-xs-2">Coordinate</label>
												<div class="col-xs-10">
													<input type="text" id="coordinate" class="form-control" name='coordinate' placeholder="0,0,0,0" value="{{ $panelMain->imagemap->coordinate }}">
												</div>
											</div>
									  
											<div class="form-group">
												<label for="inputPassword" class="control-label col-xs-2">Target</label>
												<div class="col-xs-10">
													<input type="text" id="target" class="form-control" name='target' placeholder="Value" value="{{ $panelMain->imagemap->target }}">
												</div>
											</div>
										</div>
										<div class="form-group">
										  	<div class="col-xs-offset-2 col-xs-10">
											  	<a class="btn btn-default text-center" id="btnSetSectionMainPanel" data-url = "{{ $homeCmsLink }}/setsectionmainpanel" data-password = "{{ $adminPassword }}" data-index="{{$sectionId}}" data-productindex="{{ $panelMainId }}" data-userid="{{$userId}}">Submit</a>
										 	 </div>
										</div>
									</form>
									<hr/>
									<span style='display:none;'>{{ $panelMainId++ }}</span>
								@endforeach
							</div>
					 	</div>
					</div>
					<span style='display:none;'> {{ $collapse++; }}</span>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">Set Product Panel</a>
							</h4>
						</div>
						<div id="collapse{{$collapse}}" class="panel-collapse collapse">
							<div class="panel-body">

							<span style='display:none;'>{{ $panelMainId = 0 }}</span>

							  @foreach($section->product_panel as $product_panel)  
									<span style='display:none;'>{{ $panelMainId }}</span>
									<form class="form-horizontal">
										<div class="form-group">
											<label for="inputEmail" class="control-label col-xs-2">Type of Product Panel</label>
											  	<div class="col-xs-10">
													<div class="btn-group">
														<button data-toggle="dropdown" id="mybutton{{ $panelMainId }}" class="btn btn-default dropdown-toggle"><span id="btntext{{$panelMainId}}">Product</span><span class="carete"></span></button>
														<ul class="dropdown-menu">
															@foreach($nodeTypes as $types)
															  <li>&nbsp;&nbsp;&nbsp;<span style='cursor:pointer;' data-index='{{ $panelMainId }}' class='{{$types->value}}'>{{$types->value}}</span ></li>
															@endforeach
														</ul>
													</div>				  
											 	 </div>
										</div>
										<div class="form-group">
											<label for="inputPassword" class="control-label col-xs-2">Type</label>
											<div class="col-xs-10">
												<input type="text" id="type" class="form-control" readonly='readonly' placeholder="Value" value="{{ $panelMain->type }}">
											</div>
										</div>
										<div class="form-group">
											<label for="inputPassword" class="control-label col-xs-2">Value</label>
											<div class="col-xs-10">
												<input type="text" id="value" class="form-control"  placeholder="Value" value="{{ $product_panel->value }}">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-offset-2 col-xs-10">
												<a class="btn btn-default text-center" id="btnSetSectionPanel" data-url = "{{ $homeCmsLink }}/setSectionProduct" data-password = "{{ $adminPassword }}" data-index="{{$sectionId}}" data-productindex="{{ $panelMainId }}" data-userid="{{$userId}}">Submit</a>
											</div>
										</div>
									</form>
								  <hr/>
								  <span style='display:none;'>{{ $panelMainId++ }}</span>
							  @endforeach
							</div>
						</div>
					</div>
						<span style='display:none;'> {{ $collapse++; }}</span>
				  	</div>
				</div>	
		@endforeach

    	<div class="tab-pane fade active in" id="setText">
			<form method="post" >
				<fieldset>
						<!-- Form Name -->
					<legend>Manage Banner Text</legend>
					<div class="form-group ">
						<label for="userId" class="col-sm-2 control-label">Banner Text</label>
						<div class="col-sm-10">
							{{ Form::text('value', "$value", array('id' => 'bannertext','class' => 'form-control')) }}
							{{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}    
							{{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}    
							{{ Form::hidden('hash', "", array('id' => 'hash')) }}
						</div>
					</div>
					<div class="form-group">
						<div style='text-align:center;padding-top:10px;'>
						  	<br/>
						 		<a1 href="#"  class="btn btn-default text-center" data-url = "{{ $homeCmsLink }}/settext" id="submitBannerText">Submit</a>
						</div>
					</div>
				</fieldset>
			</form>
      	</div>
	<!-- here -->
	<div class="tab-pane fade" id="mainSlide" style='margin-bottom:-250px;'>
		<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Add Main Slide</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body">
							<form id='mainSlideForm' target="test" action="{{ $homeCmsLink}}/addmainslide" class="form-horizontal" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="inputPassword" class="control-label col-xs-2">Choose File</label>
									<div class="col-xs-10">
										<input type="file" id="photoFile" name='myfile'> 
									</div>
								</div>
									<input type="text" id="valueMainSlide" class="form-control" readonly='readonly' value='Image' name='value'  placeholder="Value" style="display:none;">
								<div class="form-group">
									<label for="inputPassword" class="control-label col-xs-2">Coordinate</label>
									<div class="col-xs-10">
										<input type="text" id="mainSlideCoordinate" class="form-control" name='coordinate' value="0,0,589,352" placeholder="0,0,0,0" >
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword" class="control-label col-xs-2">Target</label>
									<div class="col-xs-10">
										<input type="text" id="mainSlideTarget" class="form-control" name='target'  placeholder="Value" >
									</div>
								</div>
								<input type="hidden" id="userIdMainSlide" class="form-control" name = 'userid' value='{{$userId}}'  placeholder="Value" >
								<input type="hidden" id="hashMainSlide" class="form-control" name = 'hash' value=''  placeholder="Value" >
					

								<div class="form-group">
									<div class="col-xs-offset-2 col-xs-10">
										<a1 href="#"  class="btn btn-default text-center" data-password="{{$adminPassword}}" data-url = "{{ $homeCmsLink }}/addmainslide" id="submitAddMainSlide">Submit</a>
									</div>
								</div>
							 </form>
						</div>
					</div>
				</div>

			  <div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							Manage Main Slide
							</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse in">
						<div class="panel-body">
							<fieldset>
								<!-- Form Name -->
								<div class="form-group ">
									<div class="col-lg-15" style='text-align:center;'>
										 @foreach ($mainSlides as $mainSlide)
											<div style="position:relative;display:inline-block;">
											<div class='well' style="height:210px;">
											<p>
												<img src="{{$easyShopLink}}/{{ $mainSlide->value }}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive'/>
											</p>

											<a href="#myMain{{ $mainSlideId }}" data-toggle="modal" style="position:absolute;top:180px;left:135px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
											<a class="btn btn-default" 
												id="deleteMainSlide" 
												data-index="{{$mainSlideId}}"  
												data-nodename="mainSlide" 
												data-userid="{{$userId}}"												 
												data-password="{{$adminPassword}}"
												style="position:absolute;top:2px;left:5px;"
												data-url = "{{ $homeCmsLink }}/removeContent"
											 ><font color='red'><b>X</b></font></a>

											<a 
												id="moveup" 
												 data-action="up" 
												 data-index="{{$mainSlideId}}" 
												 data-userid="{{$userId}}" 
												 data-value="{{$mainSlide->value}}" 
												 data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
												 data-target="{{$mainSlide->imagemap->target}}" 
												 data-order="{{$mainSlideId}}" 
												 data-password="{{$adminPassword}}"
												 style="position:absolute;top:180px;left:5px;"
												 data-url = "{{ $homeCmsLink }}/setmainslide"
											 ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

											 <a  
												id="movedown" 
												data-action="up" 
												data-index="{{$mainSlideId}}" 
												data-userid="{{$userId}}" 
												data-value="{{$mainSlide->value}}" 
												data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
												data-target="{{$mainSlide->imagemap->target}}" 
												data-order="{{$mainSlideId}}" 
												data-count="{{$mainSlideCount}}" 
												data-password="{{$adminPassword}}"
												style="position:absolute;top:180px;right:5px;"
												data-url = "{{ $homeCmsLink }}/setmainslide"
											 ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
											 </div>
											<div class="modal fade" id="myMain{{ $mainSlideId }}" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" style='margin-top:2px;'><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
																<h4 class="modal-title" id="myModalLabel">Edit Main Slide</h4>
															</div>
														<div class="modal-body">
									                     <form id='mainSlideForm' target="test" action="{{ $homeCmsLink}}/addmainslide" class="form-horizontal" method="post" enctype="multipart/form-data">

									                        <fieldset>
									                        <!-- Form Name -->
									                        {{ Form::hidden('index', $mainSlideId) }}
									                        {{ Form::hidden('userid', $userId) }}
									                        {{ Form::hidden('value', "$mainSlide->value", array('id' => 'mainSlideImage','class' => 'form-control')) }}
									                        <div class="form-group ">
									                       		  <label for="userId" class="col-sm-2 control-label">Value</label>
										                          <div class="col-sm-10">
										                           		{{ Form::text('coordinate', $mainSlide->value, array('id' => 'mainSlideValue','class' => 'form-control')) }}
										                          </div>
										                          <label for="userId" class="col-sm-2 control-label">Coordinate</label>
										                          <div class="col-sm-10">
										                           		{{ Form::text('coordinate', $mainSlide->imagemap->coordinate, array('id' => 'mainSlideCoordinate','class' => 'form-control')) }}
										                          </div>
										                           <label for="userId" class="col-sm-2 control-label">Target</label>
										                          <div class="col-sm-10">
										                          		{{ Form::text('target', $mainSlide->imagemap->target, array('id' => 'mainSlideTarget','class' => 'form-control')) }}
										                          </div>
									                        </div>
									                        </fieldset>
									                            <a href="" class="btn btn-primary"
									                             data-index="{{$mainSlideId}}" 
									                             data-userid="{{$userId}}" 
									                             data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
									                             data-target="{{$mainSlide->imagemap->target}}" 
									                             data-order="{{$mainSlideId}}" 
									                             data-count="{{$mainSlideCount}}"
									                             data-password="{{$adminPassword}}"
									                             data-url = "{{ $homeCmsLink }}/setmainslide"

									                             data-dismiss = "modal" id='submit'>Submit</a>
									                        </form> 
														</div>
													 </div>
												</div>
											  </div>
											</div><span style="display:none;">{{$mainSlideId++}}</span>
										@endforeach
									</div>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
		</div>
	</div>  
		  
	   
    <div class="tab-pane fade" id="productSlideTitle">
        <form method="post" \>
			<fieldset>
				  <!-- Form Name -->
				<legend>Manage Product Slide Title</legend>
				<div class="form-group ">
					<label for="userId" class="col-sm-2 control-label">Product Slide Title</label>
					<div class="col-sm-10">
						{{ Form::text('productSlideTitle', "$productSlideTitle", array('id' => 'slidetitle','class' => 'form-control')) }}
						{{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}    
						{{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
						{{ Form::hidden('hash', "", array('id' => 'hash1')) }}
					</div>
				</div>
				<div class="form-group">
					<div style='text-align:center;padding-top:10px;'>
					<br/>
					<a href="#"  class="btn btn-default text-center" data-url = "{{ $homeCmsLink }}/setProductTitle" id="submitProductSlideTitle"
						>Submit</a>
					</div>
				</div>
			</fieldset>
        </form>
    </div>

    <div class="tab-pane fade" id="addSectionMainPanel">
        <legend>Add Section Main Panel</legend>
			<form class="form-horizontal" id="formSectionMainPanel" method='post' >
				<div class="form-group">
					<label for="inputEmail" class="control-label col-xs-2">Type of Main Panel</label>
					<div class="col-xs-10">
						<div class="btn-group">
							<button data-toggle="dropdown" id="mybuttonsm" class="btn btn-default dropdown-toggle"><span id="btntext{{$panelMainId}}">Product</span> <span class="carete"></span></button>
							<ul class="dropdown-menu">
								@foreach($nodeTypes as $types)
									<li>&nbsp;&nbsp;&nbsp;<span style='cursor:pointer;' data-index='sm' class='{{$types->value}}'>{{$types->value}}</span ></li>
								@endforeach
							</ul>
						</div>			  
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Section Head</label>
					<div class="col-xs-10">
							<button data-toggle="dropdown" id="mybuttonsh" class="btn btn-default dropdown-toggle"><span id="btntext{{$panelMainId}}">--Choose Section Head--</span> <span class="carete"></span></button>
							<ul class="dropdown-menu">
								<span style="display:none;">{{$sectionIndex = 0}}</span>
								@foreach($sectionHeads as $types)

									<li>&nbsp;&nbsp;&nbsp;<span style='cursor:pointer;' data-index='sh' class='{{$types->value}}' data-sectionindex = "{{$sectionIndex}}">{{$types->value}}</span ></li>
									<span style="display:none;">{{$sectionIndex++}}</span>							
								@endforeach
							</ul>						
						<!-- <input tyssspe="text" id="indexSectionMainPanel" class="form-control" name= 'index' placeholder="Value" value=""/> -->
					</div>
				</div>		  
				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Type</label>
					<div class="col-xs-10">
						<input type="hidden" id="indexSectionMainPanel" class="form-control" name= 'indexSectionMainPanel' readonly='readonly' placeholder="Value" value="none">
						<input type="text" id="typeSectionMainPanel" class="form-control" name= 'type' readonly='readonly' placeholder="Value" value="Product">
					</div>
				</div>  
   
				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Value</label>
					<div class="col-xs-10">
						<input type="text" id="valueSectionMainPanel" class="form-control" name='value'  placeholder="Value" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Product index</label>
					<div class="col-xs-10">
						<input type="text" id="productindexSectionMainPanel" class="form-control" name='productindex' placeholder="Product Index" value="">
					</div>
				</div>
				<div id='imagetypesm' style="display:none;">
				  <div class="form-group">
						<label for="inputPassword" class="control-label col-xs-2">Coordinate</label>
						<div class="col-xs-10">
							<input type="text" id="coordinateSectionMainPanel" class="form-control" name='coordinate' placeholder="0,0,0,0" value="">
						</div>
				  </div>
			  
				<div class="form-group">
						<label for="inputPassword" class="control-label col-xs-2">Target</label>
						<div class="col-xs-10">
							<input type="text" id="targetSectionMainPanel" class="form-control" name='target'  placeholder="Value" value="">
						</div>
				  </div>
			    </div>

				<input type="hidden" id="userIdSectionMainPanel" class="form-control" name= 'userid' readonly='readonly' placeholder="Value" value="{{$userId}}"/>
				<input type="hidden" id="passwordSectionMainPanel" class="form-control" name= 'password' readonly='readonly' placeholder="Value" value="{{$adminPassword}}"/>

			  	<div class="form-group">
					<div class="col-xs-offset-2 col-xs-10">
						<a href="#"  class="btn btn-default text-center" data-url = "{{ $homeCmsLink }}/addSectionMainPanel" id="submitSectionMainPanel">Submit</a>
					</div>
			 	</div>
		  </form>
    </div>
    <div class="tab-pane fade" id="AddSectionProduct">
        <legend> Add Section Product</legend>

			<form class="form-horizontal" id='formSectionProduct'  method='post'>


				<input type="text" id="typeSectionProduct" class="form-control" name= 'type' readonly='readonly' placeholder="Value" value="Product"  style="display:none;"/>
		
				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Type</label>
					<div class="col-xs-10">
						<div class="btn-group" >
							<button data-toggle="dropdown" id="mybutton20000001" class="btn btn-default dropdown-toggle"><span id="btntext{{$panelMainId}}">Product</span> <span class="carete"></span></button>
							<ul class="dropdown-menu" id='sectionProductDrop'>
								@foreach($nodeTypes as $types)
									<li>&nbsp;&nbsp;&nbsp;<span style='cursor:pointer;' data-index = "20000001"class='{{$types->value}}'>{{$types->value}}</span ></li>
								@endforeach                                
							</ul>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Index</label>
<!-- 					<div class="col-xs-10">
						<input type="text" id="indexSectionProduct" class="form-control" name="index" placeholder="Value" />
					</div> -->
					<div class="col-xs-10">
							<button data-toggle="dropdown" id="mybuttonsp" class="btn btn-default dropdown-toggle"><span id="btntext{{$panelMainId}}">--Choose Section Head--</span> <span class="carete"></span></button>
							<ul class="dropdown-menu">
								<span style="display:none">{{$sectionIndex=0}}</span>
								@foreach($sectionHeads as $types)

									<li>&nbsp;&nbsp;&nbsp;<span style='cursor:pointer;' data-index='sp' class='{{$types->value}}' data-sectionindex = "{{$sectionIndex}}">{{$types->value}}</span ></li>
									<span style="display:none;">{{$sectionIndex++}}</span>							
								@endforeach
							</ul>						
					</div>					
				</div>	
				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Value</label>
					<div class="col-xs-10">
						<input type="hidden" id="indexSectionProduct" class="form-control" name="index" placeholder="Value" />						
						<input type="text" id="valueSectionProduct" class="form-control" name="value" placeholder="Value" />
					</div>
				</div>	

				<div class="form-group">
					<label for="inputPassword" class="control-label col-xs-2">Product Index</label>
					<div class="col-xs-10">
						<input type="text" id="productIndexSectionProduct" name="productindex" class="form-control"  placeholder="Product Index" />
					</div>
				</div>

				<input type="hidden" id="userIdSectionProduct" class="form-control" name= "userid" readonly='readonly' placeholder="Value" value="{{$userId}}"/>
				<input type="hidden" id="passwordSectionProduct" class="form-control" name= "password" value='{{ $adminPassword}}' readonly='readonly' placeholder="Value" value="{{$userId}}">

				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-10">
						<a href="#"  class="btn btn-default text-center" data-url = "{{ $homeCmsLink }}/addSectionProduct" id="submitSectionProduct">Submit</a>
					</div>
				</div>
			</form>

    </div>

    <div class="tab-pane fade" id="nodeTypes">
        <legend> Add Type</legend>
        <form class="form-horizontal">
			<div class="form-group">
				<label for="inputEmail" class="control-label col-xs-2">Type</label>
				<div class="col-xs-10">
					<input type="text" id="type" class="form-control" name='value'  placeholder="Type" value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-offset-2 col-xs-10">
					<a href="#"  class="btn btn-default text-center" data-url = "{{ $homeCmsLink }}/addType" data-userid="{{$userId}}" data-password = "{{$adminPassword}}" id="btnAddType" >Submit</a>
				</div>
			</div>
		</form>
    </div>
	
	<div class="modal fade" id="loading" >
        <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body" style='text-align:center;`'>
					<img src="{{{ asset('images/orange_loader.gif') }}}">
					<h3>Please Wait..</h3>        
				</div>
			</div>
        </div>
    </div>
	<div class="modal fade" id="success" >
        <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body" style='text-align:center;'>
					<img src="{{{ asset('images/es_32x32.png') }}}">
					<h3>Success</h3>        
				</div>
			</div>
        </div>
    </div>
    <div class="modal fade" id="error" >
        <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body" style='text-align:center;'>
					<img src="{{{ asset('images/img_alert.png') }}}">
					<h3>Please try again</h3>        
				</div>
			</div>
        </div>
    </div>
    <div class="modal fade" id="customerror" >
        <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body" style='text-align:center;'>
					<img src="{{{ asset('images/img_alert.png') }}}">
					<h3 id="errorTexts">Product slug does not exist</h3>        
				</div>
			</div>
        </div>
    </div>    

    <div class="tab-pane fade" id="productSideBanner">
        <form method="post" >     
			<fieldset>
				<!-- Form Name -->
				<legend>Manage Product Side Banner</legend>
				<div class="form-group ">
					<label for="userId" class="col-sm-2 control-label">Product Side Banner</label>
					<div class="col-sm-10">
						{{ Form::text('productSideBanner', "$productSideBanner", array('id' => 'sidebanner','class' => 'form-control')) }}
						{{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
						{{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
						{{ Form::hidden('hash', "", array('id' => 'hash2')) }}
					</div>
				</div>
				<div class="form-group">
					<div style='text-align:center;padding-top:10px;'>
					<br/>
					<a href="#"  class="btn btn-default text-center" data-url = "{{ $homeCmsLink }}/setProductSideBanner" id="submitProductSidebanner"
						>Submit</a>
					</div>
				</div>
			</fieldset>
        </form>
      </div>

	   	<div class="tab-pane fade " id="productSlide" >
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#addProductSlide">
							Add Product Slide
							</a>
						</h4>
					</div>
					<div id="addProductSlide" class="panel-collapse collapse in">
						<div class="panel-body">
							<form action="#" id="addProductForm" class="form-horizontal" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="inputPassword" class="control-label col-xs-2">Value</label>
									<div class="col-xs-10">
										<input type="text" id="valueProductSlide" class="form-control" name='value'  placeholder="Value" >									
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-offset-2 col-xs-10">
										<a href="#"  class="btn btn-default text-center" data-userid="{{$userId}}" data-password="{{$adminPassword}}" data-url = "{{ $homeCmsLink }}/addproductslide" id="submitAddProduct">Submit</a>
									</div>
								</div>
							 </form>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#manageproductslide">
							Manage Product Slide
							</a>
						</h4>
					</div>
					<div id="manageproductslide" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="form-group "> 
								<div class="col-lg-15" style='text-align:center'>

									@for($i=0; $i < count($productSlide) ; $i++)
										@for($y=0;$y < 1;$y++)
		  
											<div style="position:relative; display:inline-block;">
											<div class='well' style="height:210px;">
													<p><img src="{{$easyShopLink}}/{{$productSlide[$i][$y]['product_image_path']}}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive' ></p>
													<a class="btn btn-default" 
														id="deleteMainSlide" 
														data-index="{{$i}}"  
														data-nodename="productSlide" 
														data-userid="{{$userId}}"												 
														data-password="{{$adminPassword}}"
														style="position:absolute;top:2px;left:5px;"
														data-url = "{{ $homeCmsLink }}/removeContent"
													 ><font color='red'><b>X</b></font></a>


													 <a  id="moveUpProductSlide" 
													  data-index='{{$i}}'
													  data-password = '{{ $adminPassword }}'
													  data-userid="{{$userId}}" 
													  data-order='{{$i}}'
													  data-count="{{$productSlideCount}}" 
													  data-value="{{$productTypes[$i]['value']}}" 
													  data-type="{{$productTypes[$i]['type']}}" 
													  data-url = "{{ $homeCmsLink }}/setproductslide"

													 style="position:absolute;top:180px;left:5px;"><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>
														  <a href="#myModal{{$i}}" data-toggle="modal" style="position:absolute;top:180px;left:135px;">
														  	<span class="glyphicon glyphicon-edit" style="font-size:16px;"></span>
														  </a>

													  <a  id="moveDownProductSlide" 
													  data-index='{{$i}}'
													  data-password = '{{ $adminPassword }}'
													  data-userid="{{$userId}}" 
													  data-order='{{$i}}'
													  data-count="{{$productSlideCount}}" 
													  data-value="{{$productTypes[$i]['value']}}" 
													  data-type="{{$productTypes[$i]['type']}}" 
													  data-url = "{{ $homeCmsLink }}/setproductslide"

													 style="position:absolute;top:180px;right:5px;"><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
											</div>
													<!-- Modal -->
												<div class="modal fade" id="myModal{{$i}}" >
												  <div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" style='margin-top:2px;'><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
																<h4 class="modal-title" id="myModalLabel">Edit Product Slide</h4>
															</div>
															  <div class="modal-body">

																	<form method="post" id='productSlideForm'  >       
																		<fieldset>
																		<label for="userId" class="col-sm-2 control-label">Value</label>
																		<div class="col-sm-10">
																			{{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
																			{{ Form::text('value', $productTypes[$i]['value'], array('id' => 'productSlideValue','class' => 'form-control')) }}
																		</div>
																		<label for="userId" class="col-sm-2 control-label">Type</label>
																		<div class="col-sm-10">
																			{{ Form::text('type', $productTypes[$i]['type'], array('id' => 'productSlideType','class' => 'form-control','readonly' => 'readonly')) }}
																		</div>
																		</fieldset>
																	<br/>
																	  <a href="" class="btn btn-primary" data-dismiss = "modal"
																		data-index='{{$i}}'
																		data-userid="{{$userId}}" 
																		data-order='{{$i}}'
																		data-count="{{$productSlideCount}}" 
																		data-url = "{{ $homeCmsLink }}/setproductslide"

																		
																		id='submitProductSlide'>Submit</a> 
																	</form>
																</div>
														</div>
													</div>
												</div>
											</div>       
										@endfor
									@endfor					 
								</div>
							</div>  
						</div>
					</div>
				</div>
		</div>		 
	</div>
	</div>

@stop
@section('page_js') 
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/src/cms.js') }}
{{ HTML::script('js/src/jquery.form.js') }}

@stop

