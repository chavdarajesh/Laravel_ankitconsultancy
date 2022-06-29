@extends('front.layouts.main')
@section('title', 'About Page')
@section('css')
<style>
     @import url('https://fonts.googleapis.com/css2?family=Taviraj:wght@500&display=swap');

    .about .content h3,.call-to-action h3{
        font-size: 40px !important;
        /* font-family: 'DM Serif Text', serif; */
    }

    main p{
        font-size: 28px !important;
        font-family: 'Taviraj', serif;
    }
    @media only screen and (max-width: 767px) {
        main p{
        font-size: 22px !important;
    }
    }
</style>
@stop
@section('content')
    @php
    use App\Models\Admin\Faqs;
    $Faqs = Faqs::get_all_faqs();
    @endphp
    <main id="main">
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url({{ asset('assets/front/img/page-header.jpg') }});">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>About Us</h2>
                            <p>Planning Is Bringing The Future Into The Present So That You Can Do Somthing About It Now.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>About Us</li>
                    </ol>
                </div>
            </nav>
        </div>


        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">

                    <div class="col-lg-12 content order-last  order-lg-first">
                        <h3>About Us</h3>
                        <p>
                            Planning Is Bringing The Future Into The Present So That You Can Do Somthing About It Now.
                        </p>
                        <p>We Have Planned A System To Meet Long -term Financial Goals We Analyze Your Goals And Recommend
                            An Investment Strategy Designed To Meet Your Risk Tolerance</p>

                    </div>
                </div>

            </div>
        </section>
        @if (!$Faqs->isEmpty())

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
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>

                </div>
            </section>
        @endif
    </main>


@stop
