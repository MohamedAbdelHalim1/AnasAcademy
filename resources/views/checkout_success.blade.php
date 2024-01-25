@extends('layouts.app')

@section('style')

<style>
    td > a{
            font-size:15px;
            text-decoration:none;
            color:black;
        }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left;font-weight:bold;">Your Order Received successfully</h3>
                 </div>

                <div class="card-body">
                    <h3><i>"We will Keep track Your delivery Process"</i></h3>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
