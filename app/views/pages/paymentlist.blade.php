@extends('layouts.default')

@section('description', 'Payment List')
@section('keywords', '')
@section('title', 'Payment List | Easyshop Admin')
@section('header_tagline', 'Payment List.')


@section('page_header')
    @include('includes.header')
@stop


@section('content')
  <div id="mainsection">
        
        <table style='align:center'>
            <tr>
                <td>Username</td>
                <td>Bank</td>
                <td>Account Name</td>
                <td>Account No.</td>
                <td>Email</td>
                <td>Contact No.</td>
                <td>NET</td>
            </tr>

        </table>


  </div>
@stop