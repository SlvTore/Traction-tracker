<?php
// filepath: resources/views/dashboard-metrics/edit.blade.php
@extends('layouts.app')

@section('title', 'Edit Metric')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <i class="bi bi-arrow-bar-left fw-bold fs-1"></i>
            <h2>
                {{ __('Metrics') }}
            </h2>
        </div>

        <div class="col-lg-4">
            <form class="d-flex" role="search">
                <input class="form-control me-2 rounded" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
@endsection

@section('content')
     <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-funnel"></i></label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>All</option>
                                    <option value="1">Created by Me</option>
                                    <option value="2">Starred Metrics</option>
                                    <option value="3">Certified Metrics</option>
                                    <option value="4">Not Shared with Me</option>
                                    <option value="5">Shared with me</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                           <table class="table" id="metricsTableData">
                                <thead>
                                    <tr>
                                        
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
