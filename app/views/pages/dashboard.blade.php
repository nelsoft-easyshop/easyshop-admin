@extends('layouts.default')

@section('description', 'Administrator Dashboard')
@section('keywords', '')
@section('title', 'Dashboard | Easyshop Admin')



@section('page_header')
	<!-- no page header -->
@stop



@section('content')

    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>
    
    <div id="banner">
	<p><img src= "{{{ asset('images/img_logo.png') }}}" alt="easyshop" style='margin-top:35px;'></p>
	<p><h3 id='tagline'>&#169;  www.easyshop.ph</h3></p>
    </div>
    
    <div id="nav">

	<div style=""> 
	    <a href="/">
		<img src="{{{ asset('images/es_32x32.png') }}}"/> 
		<span>EASYSHOP</span> 
	    </a>
	</div>
	
	<div class='ul_cont'>
	  <div>Signed-in as:</div>
	  <div>
	    <ul>
	      <li>{{{ $username }}}</li>
	      <li>|</li>
	      <li><a href="logout">Sign-out</a></li>
	    <ul>
	  </div>
	</div>
	
	
    </div>
    
    <div id="mainsection">	
	  <ul class="featurebox">
	      <li>
		  <a href='/users'>
		      <img src="{{{ asset('images/icon_people.png') }}}"/> 
		      <span >Registered Users</span>
		  </a>
		  <p> View the complete list of registered users and their personal details. Manage and update various user information.</p>
	      
	      </li>
	      <li>	
		  <a>
		      <img src="{{{ asset('images/icon_list.png') }}}"/> 
		      <span>Transactions List</span>
		  </a>
		  <p> Monitor and manage on-going transactions on the site. Generate transactions record spreadsheets & void invalid transactions </p>
	      </li>
	      
	      <li>	
		  <a>
		      <img src="{{{ asset('images/icon_product.png') }}}"/> 
		      <span>Product Listings</span>
		  </a>
		  <p>View all active listings on the site for all users. Search for specific items and view the available product details.</p>
	      </li>
	      
	         <li>	
		  <a>
		      <img src="{{{ asset('images/icon_category.png') }}}"/> 
		      <span>Category Listing</span>
		  </a>
		  <p>
		      Manage and update all available categories on the site. Add, edit, remove and change the sor order of different categories. 
		  </p>
	      </li>
	      
	  </ul>
    </div>
    
@stop