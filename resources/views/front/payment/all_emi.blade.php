@extends('front.layouts.main')
@section('title', 'Installment Page')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url({{asset('assets/front/img/page-header.jpg') }});">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Your All Installment</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>All Installment</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <span>Hi! {{Auth::user()->name}} </span>
                    <h2>Hi! {{Auth::user()->name}} </h2>
                    <h3> Your Latest Installment </h3><p>(Total Installment = 60, Paid Installment = {{count($Payments)}}, Remaining Installment = {{60-count($Payments)}})</p>

                </div>

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-8">

                        <div class="accordion accordion-flush" id="faqlist">
                            @php $counter=0 @endphp
                            @foreach ($Payments as $Payment)
                            @php $counter ++ @endphp
                            <div class="accordion-item shadow-lg">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed justify-content-center" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-{{$Payment->id}}">
                                        {{-- <span class="bg-secondary text-white rounded  py-1 px-3">{{$counter}}</span> --}}
                                        <style>
                                            .bi-question-circle-{{$counter}}::before {
                                                content: "{{$counter}}";
                                            }
                                        </style>
                                        <i class="bi bi-question-circle-{{$counter}} question-icon"></i>
                                        Amount :- {{$Payment->emi_amount}} | Installment Date:- {{$Payment->created_at}} | Reference ID -  {{$Payment->id}}
                                    </button>
                                </h3>
                                <div id="faq-content-{{$Payment->id}}" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <h6>Your Screen Shot</h6>
                                       <img class="shadow-lg w-100" src="{{ asset($Payment->payment_screenshot)}}" alt="">
                                    </div>
                                </div>
                            </div>
                            @endforeach



                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->


    </main><!-- End #main -->


@stop
