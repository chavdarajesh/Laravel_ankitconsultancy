@extends('front.layouts.main')
@section('title', 'About Page')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url({{asset('assets/front/img/page-header.jpg') }});">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Your All EMI</h2>
                            <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas
                                consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione
                                sint. Sit quaerat ipsum dolorem.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>All EMI</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <span>Hi! {{Auth::user()->name}} </span>
                    <h2>Hi! {{Auth::user()->name}} </h2>
                    <h3> Your Letest Instalments </h3><p>(Total Instalments - {{count($Payments)}}) </p>

                </div>

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-12">

                        <div class="accordion accordion-flush" id="faqlist">
                            @php $counter=0 @endphp
                            @foreach ($Payments as $Payment)
                            @php $counter ++ @endphp
                            <div class="accordion-item shadow-lg">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-{{$Payment->id}}">
                                        <span class="bg-secondary text-white rounded px-3 py-1 mx-2 h3">{{$counter}}</span>
                                       <h3> Amount :- {{$Payment->emi_amount}} | Instalment Date:- {{$Payment->created_at}} | Reference ID -  {{$Payment->id}}</h3>
                                    </button>
                                </h3>
                                <div id="faq-content-{{$Payment->id}}" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <h4>Your Screen Shot</h4>
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
