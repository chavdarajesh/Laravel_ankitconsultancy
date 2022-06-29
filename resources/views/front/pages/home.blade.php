@extends('front.layouts.main')
@section('title', 'Home Page')
@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Taviraj:wght@500&display=swap');

        .about .content h3,
        .call-to-action h3 {
            font-size: 40px !important;
        }

        main p {
            font-size: 28px !important;
            font-family: 'Taviraj', serif;
        }

        @media only screen and (max-width: 767px) {
            main p {
                font-size: 22px !important;
            }
            .bg-video-wrap , video{
                min-height: 100vh !important;
            }
            .overlay,.bg-video-wrap{
                height: 100vh !important;
            }
        }

        .hero {
            background-image: unset !important;
        }.hero h2{
            color: black
        }

        .bg-video-wrap {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 100vh;
            /* background: url(https://designsupply-web.com/samplecontent/vender/codepen/20181014.png) no-repeat center center/cover; */
        }

        video {
            position: absolute;
            top: 0;
            width: 100%;
            min-width: 100%;
            min-height: 100vh;
            /* z-index: 1; */
        }

        .overlay {
            width: 100%;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            /* background-image: linear-gradient(45deg, rgba(0, 0, 0, .3) 50%, rgba(0, 0, 0, .7) 50%); */
            background-size: 3px 3px;
            /* z-index: 2; */
        }
    </style>
@stop
@section('content')
    @php
    use App\Models\Admin\Faqs;
    use App\Models\Admin\ContactSetting;
    $Faqs = Faqs::get_all_faqs();
    @endphp

    <section id="hero" class="hero d-flex align-items-center bg-video-wrap">
        <video  loop muted autoplay>
            <source src="{{asset('assets/front/videos/homepage/3943971.mp4')}}" type="video/mp4">
                Your browser does not support the video tag.
        </video>
        <div class="overlay">
        </div>
        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-12 m-auto order-2 order-lg-1 d-flex flex-column text-center justify-content-center">
                    <h2 data-aos="fade-up">Don't Wait For The Perfect Moment ,<br> Take The Moment And Make It Perfect</h2>


                    <form action="#" class="form-search d-flex align-items-stretch mb-3 w-auto m-auto" data-aos="fade-up"
                        data-aos-delay="200">
                        @if (Auth::check())
                        @else
                            <a href="{{ route('front.register') }}" class="btn btn-primary w-auto m-auto">Register</a>
                        @endif
                    </form>


                </div>



            </div>
        </div>
    </section>

    <main id="main">

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
        <section id="service" class="services pt-5">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <span>Our Services</span>
                    <h2>Our Services</h2>

                </div>

                <div class="row gy-4">

                    <h2 class="text-center">We Are Providing Financial Advice To Help Transform Your Business.</h2>

                </div>

            </div>
        </section>
        <section id="call-to-action" class="call-to-action">
            <div class="container" data-aos="zoom-out">

                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h3>Call To Action</h3>
                        <p> It Is Never Too Get Started On Your Investment Plans Tells Us We Will Give You A Plan To Achieve
                            Them.</p>
                        <a class="cta-btn"
                            href="tel:{{ ContactSetting::get_contact_us_details()->phone ? ContactSetting::get_contact_us_details()->phone : '+918888888888' }}">Call
                            To Action</a>
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
