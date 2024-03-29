@extends('layouts.default')

@section('description', 'List of search keywords')
@section('keywords', '')
@section('title', 'Search Keywords List | Easyshop Admin')
@section('header_tagline', 'Search Keywords')

@section('page_header')
    @include('includes.header')
@stop

@section('content')
    <div id="mainsection">
        <div class="tbl-container">
            {{ Form::open(array('url' => 'searchkeywords', 'id' => 'searchForm')) }}
                <div class="input-group srch_div" style="padding:12px">
                    <div class="inner-addon left-addon">
                        <i class="glyphicon glyphicon-search"></i>
                            <input type="text" id="searchBox" name="keyword" class="form-control" placeholder="Search Keyword" />
                    </div>
                    <div class="input-group-btn">
                        &nbsp;
                        <input type="submit" class="btn btn-primary dropdown-toggle">
                    </div>
                </div>
            {{ Form::close() }}  

            <div id="table_keywords">
                <h4 class="tbl-title">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    LIST OF SEARCH KEYWORDS
                </h4>
                <div class="tbl-div">
                    <table class="table table-striped table-hover tbl-my-style" id="tbl-user-list">
                        <thead>
                        <tr>
                            <th>Query String</th>
                            <th>Number of Hits</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_of_keywords as $words)
                            <tr >
                                <td>{{{ $words->keywords }}}</td>
                                <td>{{{ $words->hits }}}</td>                    
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $list_of_keywords->links() }}
            </div> 

           
        <div class="clear"></div>
    </div>
</div>

@stop

@section('page_js')
{{ HTML::script('js/searchkeywords.js') }}
@stop
