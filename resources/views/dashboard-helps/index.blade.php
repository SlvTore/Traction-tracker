@extends('layouts.app')

@section('title', 'Metrics')

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
        <div class="card-header" style="background-color: #FBB041" >
            <div class="text-center text-white my-4" >
                <h1>Welcome! How can we help?</h1>
                <p>Search in our help center for quick answers</p>
            </div>
        </div>

        <div class="card-body">
           <div class="card-group">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card h-100 shadow">
                            <div class="card-body text-center">
                                <img src="{{ asset('images/chatbot.png') }}" class="my-2 mx-auto" width="45px" height="auto" alt="FAQ Icon"/>
                                <h5 class="card-title">Frequently Asked Questions</h5>
                                <p class="card-text">The FAQ feature provides a list of common questions and answers to help users understand and resolve issues quickly.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 shadow">
                            <div class="card-body text-center">
                                <img src="{{ asset('images/features.png') }}" class="my-2 mx-auto" width="45px" height="auto" alt="Features Icon"/>
                                <h5 class="card-title">Features and Functionalities</h5>
                                <p class="card-text">The Features and Functionalities feature lists the key capabilities and advantages of a product or service to help users understand how it works.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 shadow">
                            <div class="card-body text-center">
                                <img src="{{ asset('images/teams.png') }}" class="my-2 mx-auto" width="45px" height="auto" alt="Users and Collaborators Icon"/>
                                <h5 class="card-title">Users and Collaborations</h5>
                                <p class="card-text ">The Users and Collaborators feature allows managing users and collaborators by setting roles, access permissions, and coordinating work on one platform.</p>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection

