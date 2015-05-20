@extends('layouts.default')

@section('description', 'List of registered users')
@section('keywords', '')
@section('title', 'Product List | Easyshop Admin')
@section('header_tagline', 'List of all products')
@section('page_header')
@include('includes.header')
@stop
@section('content')

<div id="mainsection">
    <div class="filter-container ">
        <div id="srch_container">
            <h4 class="tbl-title">
                <span class="glyphicon glyphicon-zoom-in"></span>
                ADVANCE SEARCH
            </h4>
            {{ Form::open(array('url' => 'items', 'id' => 'searchForm')) }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Item</label>
                        {{ Form::text('item', Input::old('item'), array('id' => 'src_item', 'class' => 'form-control search-string', 'placeholder' => 'Enter Item' ) ) }}
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label for="date_timepicker_start">Start Date</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            {{ Form::text('startdate', Input::old('startdate'), array('id' => 'date_timepicker_start', 'class' => 'form-control search-string' ) ) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date_timepicker_end">End Date</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            {{ Form::text('enddate', Input::old('enddate'), array('id' => 'date_timepicker_end', 'class' => 'form-control search-string' ) ) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_category">Category</label>
                        {{ Form::text('category', Input::old('category'), array('id' => 'src_category', 'class' => 'form-control search-string', 'placeholder' => 'Enter category' ) ) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_condition">Condition</label>
                        {{ Form::text('condition', Input::old('condition'), array('id' => 'src_condition', 'class' => 'form-control search-string', 'placeholder' => 'Enter condition' ) ) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_brand">Brand</label>
                        {{ Form::text('brand', Input::old('brand'), array('id' => 'src_brand', 'class' => 'form-control search-string', 'placeholder' => 'Enter brand' ) ) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_seller">Seller</label>
                        {{ Form::text('seller', Input::old('seller'), array('id' => 'src_seller', 'class' => 'form-control search-string', 'placeholder' => 'Enter name' ) ) }}
                    </div>
                </div>
                <div class="col-md-1 col-md-offset-2">
                    <div class="form-group">
                        <label for="btn_close_search">&nbsp</label>
                        <button type="button" id="btn_close_search" class="btn btn-default"> Cancel </button>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="btn_search">&nbsp</label>
                        {{ Form::submit(' Search ', array('id' => 'btn_search', 'class' => 'btn btn-primary')) }}
                    </div>
                </div>
            </div>
            {{ Form::hidden('single_search', Input::old('sd'), array('id' => 'single_search')) }}
            {{ Form::close() }}
        </div>
    </div>
    <div class="tbl-container">
        <div class="input-group srch_div">
            <div class="inner-addon left-addon">
                <i class="glyphicon glyphicon-search"></i>
                <input type="text" class="form-control" id="searchBox" placeholder="Search all items" />
            </div>
            <div class="input-group-btn">
                &nbsp;
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Filters
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu dd-right" role="menu">
                    <li role="presentation" class="dropdown-header">Search by :</li>
                    <li><a class="drct_search" data="src_item" href="javascript:void(0)">Item</a></li>
                    <li><a class="drct_search" data="src_seller" href="javascript:void(0)">Store Name</a></li>
                    <li><a class="drct_search" data="src_category" href="javascript:void(0)">Category</a></li>
                    <li><a class="drct_search" data="src_brand" href="javascript:void(0)">Brand</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)" id="btn_advance_search"><span class="glyphicon glyphicon-new-window"></span> View advance search</a></li>
                </ul>
            </div>
        </div>
        <h4 class="tbl-title">
            <span class="glyphicon glyphicon-list-alt"></span>
            LIST OF PRODUCTS
        </h4>
        <div class="tbl-div">
            <table class="table table-striped table-hover tbl-my-style" id="tbl-user-list">
                <thead>
                <tr>
                    <th>Date Created</th>
                    <th>Item</th>
                    <th>Store Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>SKU</th>
                    <th>Brief</th>
                    <th>Condition</th>
                    <th>URL</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_of_items as $item)
                <tr>
                    <td>{{{ $item->createddate }}}</td>
                    <td>{{{ $item->name }}}</td>
                    <td>{{{ $item->Member->getStoreName() }}}</td>
                    <td>{{{ $item->Category->name }}}</td>
                    <td>{{{ $item->Brand->name }}}</td>
                    <td>{{{ $item->sku }}}</td>
                    <td>{{{ $item->brief }}}</td>
                    <td>{{{ $item->condition }}}</td>
                    <td>{{{ $easyShopLink . '/item/' . $item->slug }}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $pagination }}
        <div class="clear"></div>
    </div>
</div>
@stop

@section('page_js')
{{ HTML::script('js/itemlist.js') }}
@stop
