@extends('front.layouts.main')
@section('title', 'Faqs Page')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url({{ asset('assets/front/img/page-header.jpg') }});">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Faqs</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>Faqs</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        @if (!$Faqs->isEmpty())
            <!-- ======= Frequently Asked Questions Section ======= -->
            <section id="faq" class="faq">
                <div class="container" data-aos="fade-up">

                    <div class="section-header">
                        <span>Frequently Asked Questions</span>
                        <h2>Frequently Asked Questions</h2>

                    </div>

                    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-lg-10">

                            <div class="accordion accordion-flush" id="faqlist">
                                @foreach ($Faqs as $Faq)
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $Faq->id }}">
                                                <i class="bi bi-question-circle question-icon"></i>
                                                {{ $Faq->title }}
                                            </button>
                                        </h3>
                                        <div id="faq-content-{{ $Faq->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#faqlist">
                                            <div class="accordion-body">
                                                {{ $Faq->description }}

                                            </div>
                                        </div>
                                    </div><!-- # Faq item-->
                                @endforeach



                            </div>

                        </div>
                    </div>

                </div>
            </section><!-- End Frequently Asked Questions Section -->
        @endif
    </main><!-- End #main -->


@stop
