@extends('layouts.default')

@section('description', 'List of category')
@section('keywords', '')
@section('title', 'Category List | Easyshop Admin')
@section('header_tagline', 'List of all category')
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
            {{ Form::open(array('url' => 'category', 'id' => 'searchForm')) }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Category</label>
                        {{ Form::text('category', Input::old('category'), array('id' => 'src_category', 'class' => 'form-control', 'placeholder' => 'Enter Category' ) ) }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_category">Description</label>
                        {{ Form::text('description', Input::old('description'), array('id' => 'src_description', 'class' => 'form-control', 'placeholder' => 'Enter description' ) ) }}
                    </div>
                </div>
                                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="src_condition">Keywords</label>
                        {{ Form::text('keywords', Input::old('keywords'), array('id' => 'src_keywords', 'class' => 'form-control', 'placeholder' => 'Enter keywords' ) ) }}
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-4">
                </div>

                <div class="col-md-4">
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
                <input type="text" class="form-control" id="searchBox" placeholder="Search all category" />
            </div>
            <div class="input-group-btn">
                &nbsp;
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Filters
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu dd-right" role="menu">
                    <li role="presentation" class="dropdown-header">Search by :</li>
                    <li><a class="drct_search" data="src_category" href="javascript:void(0)">Category</a></li>
                    <li><a class="drct_search" data="src_description" href="javascript:void(0)">Description</a></li>
                    <li><a class="drct_search" data="src_keyword" href="javascript:void(0)">Keywords</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)" id="btn_advance_search"><span class="glyphicon glyphicon-new-window"></span> View advance search</a></li>
                </ul>
            </div>
        </div>
        <h4 class="tbl-title">
            <span class="glyphicon glyphicon-list-alt"></span>
            LIST OF CATEGORY
        </h4>
        <div class="tbl-breadcrumb">
            <ol class="breadcrumb">
                <li data="1"><a class="breadcrumb_link redirect">Main</a></li>
                @for($x = 0 ; sizeof($breadcrumbs) > $x; $x++)
                    @if( sizeof($breadcrumbs) == ($x + 1) )
                <li class = "active" data="{{{ $breadcrumbs[$x]->id_cat }}}">{{{ $breadcrumbs[$x]->name }}}</li>
                    @else
                <li data="{{{ $breadcrumbs[$x]->id_cat }}}"><a class="breadcrumb_link redirect">{{{ $breadcrumbs[$x]->name }}}</a></li>
                    @endif
                @endfor
            </ol>
        </div>
        <div class="tbl-div">
            <table class="table table-striped table-hover tbl-my-style table-clickable" id="tbl-cat-list">
                <thead>
                <tr>
                    <th></th>
                    <th>Date Created</th>
                    <th>Sort Order</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Keyword</th>
                    <th>Slug</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_of_category as $category)
                <tr data="{{{ $category->id_cat }}}">
                    <td>
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger edit_btn" data-toggle="modal" data-target="#myModal" data_id="{{{ $category->id_cat }}}">
                                    <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                        <span class='data_container' id='data_{{{ $category->id_cat }}}'
                                              data='{
                                              "id_cat":"{{{ $category->id_cat }}}",
                                              "name":"{{{ $category->name }}}",
                                              "description":"{{{ $category->description }}}",
                                              "keywords":"{{{ $category->keywords }}}",
                                              "sort_order":"{{{ $category->sort_order }}}",
                                              "is_main":"{{{ $category->is_main }}}" } '>
                                        </span>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="redirect">{{{ '10-24-1991 06:30:05' }}}</td>
                    <td class="redirect" id="{{{ $category->id_cat }}}_sort_order">{{{ $category->sort_order }}}</td>
                    <td class="redirect" id="{{{ $category->id_cat }}}_name">{{{ $category->name }}}</td>
                    <td class="redirect" id="{{{ $category->id_cat }}}_description">{{{ $category->description }}}</td>
                    <td class="redirect" id="{{{ $category->id_cat }}}_keywords">{{{ $category->keywords }}}</td>
                    <td class="redirect">{{{ $category->slug }}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
        <div class="">
            <button type="button" id="create_cat" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >
                <span class="glyphicon glyphicon-plus-sign"></span>
                Create New
            </button>
        </div>
        <!--Start Modal -->
        <div class="modal fade user_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header orange-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="mdl_title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="mdl_name" placeholder="Enter category name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" id="mdl_description" placeholder="Enter description">
                        </div>
                        <div class="form-group">
                            <label>Keyword</label>
                            <input type="text" class="form-control" id="mdl_keyword" placeholder="Enter keyword">
                        </div>
                        <div class="form-group">
                            <label>Sort order</label>
                            <input type="text" class="form-control" id="mdl_sort" maxlength="2" onkeypress="return isNumberKey(event)" placeholder="Enter number">
                        </div>
                        
                        <div class="category-error alert alert-danger" role="alert" style="display:none; font-size: 14px;"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="mdl_save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->
    </div>
</div>
@stop

@section('page_js')
{{ HTML::script('js/categorylist.js') }}
@stop
