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
            {{ Form::open(array('url' => 'items')) }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Item</label>
                        {{ Form::text('item', Input::old('item'), array('id' => 'src_item', 'class' => 'form-control', 'placeholder' => 'Enter Item' ) ) }}
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label for="date_timepicker_start">Start Date</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            {{ Form::text('startdate', Input::old('startdate'), array('id' => 'date_timepicker_start', 'class' => 'form-control' ) ) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date_timepicker_end">End Date</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            {{ Form::text('enddate', Input::old('enddate'), array('id' => 'date_timepicker_end', 'class' => 'form-control' ) ) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_category">Category</label>
                        {{ Form::text('category', Input::old('category'), array('id' => 'src_category', 'class' => 'form-control', 'placeholder' => 'Enter category' ) ) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_condition">Condition</label>
                        {{ Form::text('condition', Input::old('condition'), array('id' => 'src_condition', 'class' => 'form-control', 'placeholder' => 'Enter condition' ) ) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_brand">Brand</label>
                        {{ Form::text('brand', Input::old('brand'), array('id' => 'src_brand', 'class' => 'form-control', 'placeholder' => 'Enter brand' ) ) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_seller">Seller</label>
                        {{ Form::text('seller', Input::old('seller'), array('id' => 'src_seller', 'class' => 'form-control', 'placeholder' => 'Enter name' ) ) }}
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
            {{ Form::close() }}
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
                    <td>{{{ $item->createddate }}}</td>
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
<script>
    jQuery(function(){
        jQuery('#date_timepicker_start').datetimepicker({
            format:'Y/m/d',
            onShow:function( ct ){
                this.setOptions({
                    maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
                })
            },
            timepicker:false
        });
        jQuery('#date_timepicker_end').datetimepicker({
            format:'Y/m/d',
            onShow:function( ct ){
                this.setOptions({
                    minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
                })
            },
            timepicker:false
        });
    });
    $(document).ready(function(){
        $('#btn_advance_search').on('click',function(){
            $('#srch_container').slideDown();
        });
        $('#btn_close_search').on('click',function(){
            $('#srch_container').slideUp();
        });
    });
</script>
@stop