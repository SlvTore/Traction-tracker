@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h2 class="h4">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control rounded" id="datepicker" name="datepicker">
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
