@extends('layouts.app')

@section('title', 'Help Center')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Help Center') }}
            </h2>
            <h6 class="mb-0 ms-1">
                {{ __('Frequently Asked Questions') }}
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
                            <h2>Frequently Asked Questions</h2>
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
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is Traction Tracker?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Traction Tracker is a tool designed to help you monitor and analyze your business metrics effectively.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How do I reset my password?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    To reset your password, go to the login page and click on "Forgot Password". Follow the instructions sent to your email.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How can I contact support?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can contact support by emailing us at support@tractiontracker.com or using the contact form on our website.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
