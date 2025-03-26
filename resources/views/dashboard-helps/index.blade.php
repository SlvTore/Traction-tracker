@extends('layouts.app')

@section('title', 'Help Center')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Help Center') }}
            </h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header" style="background-color: #FBB041; height: 200px;">
            <div class="text-center text-white my-4">
                <h1>Welcome! How can we help?</h1>
                <p>Search in our help center for quick answers</p>
            </div>
        </div>

        <div class="card-body">
            <div class="card-group">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <a href="{{ route('helpFaq') }}" class="card-link">
                            <div class="card shadow">
                                <div class="card-body text-center">
                                    <img src="{{ asset('images/chatbot.png') }}" class="my-2 mx-auto" width="35px" height="auto" alt="FAQ Icon"/>
                                    <h5 class="card-title">Frequently Asked Questions</h5>
                                    <p class="card-text">The FAQ feature provides a list of common questions and answers to help users understand and resolve issues quickly.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('helpFeatures') }}" class="card-link">
                            <div class="card shadow">
                                <div class="card-body text-center">
                                    <img src="{{ asset('images/features.png') }}" class="my-2 mx-auto" width="35px" height="auto" alt="Features Icon"/>
                                    <h5 class="card-title">Features and Functionalities</h5>
                                    <p class="card-text">The Features and Functionalities feature lists the key capabilities and advantages of a product or service to help users understand how it works.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('helpCollabs') }}" class="card-link">
                            <div class="card shadow">
                                <div class="card-body text-center">
                                    <img src="{{ asset('images/teams.png') }}" class="my-2 mx-auto" width="35px" height="auto" alt="Users and Collaborators Icon"/>
                                    <h5 class="card-title">Users and Collaborations</h5>
                                    <p class="card-text">The Users and Collaborators feature allows managing users and collaborators by setting roles, access permissions, and coordinating work on one platform.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .card-link .card {
        transform: translateY(-75px);
        height: 250px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-link .card:hover {
        transform: translateY(-75px) scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        font-size: 0.7rem;
    }
</style>
@endpush

