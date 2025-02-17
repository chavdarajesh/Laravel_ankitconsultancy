@extends('front.layouts.main')
@section('title', 'Contact Page')
@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Taviraj:wght@500&display=swap');

        .breadcrumbs p {
            font-size: 28px !important;
            font-family: 'DM Serif Text', serif;
        }

        @media only screen and (max-width: 767px) {
            .breadcrumbs p {
                font-size: 22px !important;
            }
        }
    </style>
@stop
@section('content')
@section('content')
    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Contact Us</h2>
                            <p>It Is Never Too Get Started On Your Investment Plans Tells Us We Will Give You A Plan To
                                Achieve Them.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ol>
                </div>
            </nav>
        </div>


        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                @if ($ContactSetting['map_iframe'])
                    <div>
                        {!! $ContactSetting['map_iframe'] ? $ContactSetting['map_iframe'] : '<iframe style="border:0; width: 100%; height: 340px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>' !!}
                    </div>
                @endif
                <div class="row gy-4 mt-4">
                    <h1 class="text-center">Ankit Consultancy</h1>
                    <hr>
                    <div class="col-lg-4">
                        <div class="info-item d-flex">
                            <i class="bi bi-whatsapp flex-shrink-0"></i>
                            <div>
                                <h4>Message On Whatsapp:</h4>
                                <a target="_blank"
                                    href="https://api.whatsapp.com/send?phone={{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+918888888888' }}">Send
                                    Message</a>
                            </div>
                        </div>
                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Location:</h4>
                                <p>{{ $ContactSetting['location'] ? $ContactSetting['location'] : 'A108 Adam Street, New York, NY 535022' }}
                                </p>
                            </div>
                        </div>
                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <a
                                    href="mailto:{{ $ContactSetting['email'] ? $ContactSetting['email'] : 'financialadvisory@ankitconsultancy.com' }}">{{ $ContactSetting['email'] ? $ContactSetting['email'] : 'info@example.com' }}</a>
                            </div>
                        </div>

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Call:</h4>
                                <a href="tel:{{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+91888888888' }}"
                                    class="Blondie">{{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+1 5589 55488 55' }}</a>
                            </div>
                        </div>
                        <div class="info-item d-flex">
                            <i class="bi bi-calendar-check flex-shrink-0"></i>
                            <div>
                                <h4>Timing:</h4>
                                <h6>Monday To Friday (10am-5pm) </h6>
                                <h6>Saturday and Sunday (By Appointment)</h6>
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-8">
                        <form action="{{ route('front.post.contact') }}" method="post" role="form"
                            class="php-email-form">
                            @csrf
                            <div class="row">
                                <h4 class="text-center">Send Message To US</h4>
                                <hr>
                                <div class="col-md-6 form-group">
                                    <input required type="text" name="name"
                                        class="form-control  @error('name') border border-danger @enderror" id="name"
                                        placeholder="Your Name"
                                        value="{{ Auth::check() ? Auth::user()->name : old('name') }}" autofocus>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input required type="email"
                                        class="form-control  @error('email') border border-danger @enderror" name="email"
                                        id="email" placeholder="Your Email"
                                        value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" required
                                    class="form-control  @error('subject') border border-danger @enderror" name="subject"
                                    id="subject" placeholder="Subject" value="{{ old('subject') }}">
                            </div>
                            @error('subject')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group mt-3">
                                <textarea required class="form-control   @error('message') border border-danger @enderror" name="message" rows="6"
                                    placeholder="Message">{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>
                <div class="row gy-4 mt-4">

                </div>
            </div>
        </section>

    </main>


@stop
