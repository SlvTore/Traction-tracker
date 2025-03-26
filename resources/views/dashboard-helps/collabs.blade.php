@extends('layouts.app')

@section('title', 'Help Center')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Help Center') }}
            </h2>
            <h6 class="mb-0 ms-1">
                {{ __('Users and Collaborations') }}
            </h6>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex align-items-center">
                        <a href="{{ route('helpCenter') }}" class="btn btn-outline-secondary rounded-circle me-3">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <div class="flex-grow-1 d-flex justify-content-center">
                            <h2>Users and Collaborations</h2>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 d-flex align-items-center">
                        <input type="text" class="form-control" placeholder="Search FAQs..." aria-label="Search FAQs" width="50%">
                        <button class="btn btn-primary ms-2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="row mt-3">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
