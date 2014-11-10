@extends('layouts.default')

@section('description', 'Administrator Dashboard')
@section('keywords', '')
@section('title', 'Dashboard | Easyshop Admin')



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
            <div class="section-title"> TRANSACTION MANAGEMENT </div>
           
            <li>    
                <a href="/transaction">
                    <img src="{{{ asset('images/icon_list.png') }}}"/> 
                    <span>Transactions List</span>
                </a>
                <p> Monitor and manage on-going transactions on the site. Generate transactions record spreadsheets & void invalid transactions </p>
            </li>
            
            <li>
                <a href='/pay'>
                    <img src="{{{ asset('images/img_icon_business.png') }}}"/> 
                    <span >Seller Pay-out</span>
                </a>
                <p> View details about payments for sellers that are cleared for transfer every month. Update the status of completed transactions.</p>
            
            </li>
            
            <li>
                <a href='/refund'>
                    <img src="{{{ asset('images/img_icon_business.png') }}}"/> 
                    <span >Buyer Refund</span>
                </a>
                <p> View details about refunds for buyers and update the status of the transaction</p>
            
            </li>
            
            
            <li>
                <a href='/payout/seller'>
                    <img src="{{{ asset('images/icon_people.png') }}}"/> 
                    <span>Contact Sellers</span><span class="label label-danger pull-right" style='margin-right:20px;'>{{{ $unTaggedSellersTransaction  }}}</span></span>  
                </a>
                <p> View sellers that have to be contacted</p>
            </li>                
        
            <li>
                <a href='/payout-buyer'>
                    <img src="{{{ asset('images/img_icon_business.png') }}}"/> 
                    <span >Contact Buyers</span> <span class="label label-danger pull-right" style='margin-right:20px;'>{{{$untaggedBuyerTransactionsCount}}}</span>

                </a>
                <p>View buyers that have to be contacted</p>
            
            </li>    
            
            <li>
                <a href='/messages'>
                    <img src="{{{ asset('images/icon_category.png') }}}"/> 
                    <span >Partner Messaging</span>
                </a>
                <p>Centralize all incoming messages from partner accounts that we're handling to a central account.</p>
            </li> 
            
            <div class="section-title"> CONTENT MANAGEMENT</div>
            <li>
                <a href='/home'>
                    <img src="{{{ asset('images/icon_category.png') }}}"/> 
                    <span >Manage Home Page</span>
                </a>
                <p>Manage the home page of Easyshop.ph. View and updates its different web parts.</p>
            
            </li>   
            
            <li>
                <a href='/cms/feeds'>
                    <img src="{{{ asset('images/icon_category.png') }}}"/> 
                    <span >Manage Feeds Contents</span>
                </a>
                <p>Manage the feeds section of Easyhop.ph. View and updates its different web parts.</p>

            
            </li>  
            <li>
                <a href='/mobile'>
                    <img src="{{{ asset('images/icon_category.png') }}}"/> 
                    <span >Mobile Page Manager</span>
                </a>
                <p>Content Manager for Mobile Home page. View and edit Box Contents and home page main slides</p>

            </li>      
            
            
            
            <div class="section-title"> EASYSHOP.PH DATA</div>
            <li>
                <a href='/users'>
                    <img src="{{{ asset('images/icon_people.png') }}}"/> 
                    <span >Registered Users</span>
                </a>
                <p> View the complete list of registered users and their personal details. Manage and update various user information.</p>
            
            </li>
        
            
            <li>	
                <a href="/items">
                    <img src="{{{ asset('images/icon_product.png') }}}"/> 
                    <span>Product Listings</span>
                </a>
                <p>View all active listings on the site for all users. Search for specific items and view the available product details.</p>
            </li>
            
            <li>	
                <a href="/category">
                    <img src="{{{ asset('images/icon_category.png') }}}"/> 
                    <span>Category Listing</span>
                </a>
                <p>
                    Manage and update all available categories on the site. Add, edit, remove and change the sor order of different categories. 
                </p>
            </li>
            <li>    
                <a href="/searchkeywords">
                    <img src="{{{ asset('images/icon_list.png') }}}"/> 
                    <span>View Search Keywords</span>
                </a>
                <p> View search keywords used by the users.</p>
            </li> 
            
            <li>
                <a href='/productcsv'>
                    <img src="{{{ asset('images/icon_people.png') }}}"/> 
                    <span >Product CSV Upload</span>
                </a>
                <p> Enables the administrator to upload multiple product images and product info through csv/excel files.</p>
            
            </li>  
            
            <li>
                <a href='/reports'>
                    <img src="{{{ asset('images/icon_people.png') }}}"/> 
                    <span >Reports Manager</span>
                </a>
                <p> View Users and Products overall statistics</p>

            </li>
            
            
            <div class="section-title"> ACCOUNT MANAGEMENT</div>
            <li>
                <a href='/register'>
                    <img src="{{{ asset('images/icon_category.png') }}}"/> 
                    <span >Manage Administrator </span>
                </a>
                <p>Registers an administrator user of the site. View and updates its site privileges and account status.</p>
            
            </li>      
            <li>    
                <a href="/raffle">
                    <img src="{{{ asset('images/icon_list.png') }}}"/> 
                    <span>Add Raffle</span>
                </a>
                <p> Add and view raffles. Upload raffle member CSV files or manually input pool of members for the raffle.</p>
            </li>   
      
        </ul>
    </div>
    
    
    

@stop
