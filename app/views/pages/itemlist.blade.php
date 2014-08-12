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
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Item</label>
                        <input type="email" class="form-control" id="search_item" placeholder="Enter item">
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Start Date</label>
                        <input type="email" class="form-control" id="exampleInputEmail1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">End Date</label>
                        <input type="email" class="form-control" id="exampleInputEmail1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter category">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Condition</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter condition">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Brand</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter brand">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seller</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter seller name">
                    </div>
                </div>
                <div class="col-md-1 col-md-offset-2">
                    <div class="form-group">
                        <label for="">&nbsp</label>
                        <button type="button" id="btn_close_search" class="btn btn-default">&nbsp Cancel &nbsp</button>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">&nbsp</label>
                        <button type="button" id="btn_search" class="btn btn-primary">&nbsp Search &nbsp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tbl-container">
        <div class="input-group srch_div">
            <div class="inner-addon left-addon">
                <i class="glyphicon glyphicon-search"></i>
                <input type="text" class="form-control" placeholder="Search all items" />
            </div>
            <div class="input-group-btn">
                &nbsp;
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Filters
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu dd-right" role="menu">
                    <li role="presentation" class="dropdown-header">Search by :</li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Seller</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Brand</a></li>
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
                    <th>Seller</th>
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
                    <td>{{{ $item->created_at }}}</td>
                    <td>{{{ $item->name }}}</td>
                    <td>{{{ $item->Member->username }}}</td>
                    <td>{{{ $item->Category->name }}}</td>
                    <td>{{{ $item->Brand->name }}}</td>
                    <td>{{{ $item->sku }}}</td>
                    <td>{{{ $item->brief }}}</td>
                    <td>{{{ $item->condition }}}</td>
                    <td>https://easyshop.ph/item/{{{ $item->slug }}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $list_of_items->links() }}
        <div class="clear"></div>
    </div>
</div>
@stop

@section('page_js')
{{ HTML::script('js/itemlist.js') }}
@stop
