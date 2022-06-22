@extends('front.layouts.main')
@section('title', 'Conatct Page')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Contact</h2>
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
                        <li>Contact</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div>
                    {!! $ContactSetting['map_iframe'] ?  $ContactSetting['map_iframe'] : '<iframe style="border:0; width: 100%; height: 340px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>' !!}
                </div><!-- End Google Maps -->

                <div class="row gy-4 mt-4">

                    <div class="col-lg-4">

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Location:</h4>
                                <p>{{ $ContactSetting['location'] ? $ContactSetting['location'] : 'A108 Adam Street, New York, NY 535022' }}</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <a href="mailto:{{ $ContactSetting['email'] ? $ContactSetting['email'] : 'info@example.com' }}">{{ $ContactSetting['email'] ? $ContactSetting['email'] : 'info@example.com' }}</a>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Call:</h4>
                                <a href="tel:{{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+1 5589 55488 55' }}" class="Blondie">{{ $ContactSetting['phone'] ? $ContactSetting['phone'] : '+1 5589 55488 55' }}</a>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                    <div class="col-lg-8">
                        <form action="{{ route('front.post.contact') }}" method="post" role="form"
                            class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input required type="text" name="name"
                                        class="form-control  @error('name') border border-danger @enderror" id="name"
                                        placeholder="Your Name"  value="{{ Auth::check() ? Auth::user()->name : old('name') }}" autofocus>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input required type="email" class="form-control  @error('email') border border-danger @enderror"
                                        name="email" id="email" placeholder="Your Email"
                                        value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" required class="form-control  @error('subject') border border-danger @enderror"
                                    name="subject" id="subject" placeholder="Subject"
                                    value="{{ old('subject') }}">
                            </div>
                            @error('subject')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group mt-3">
                                <textarea required class="form-control   @error('message') border border-danger @enderror" name="message" rows="5"
                                    placeholder="Message" >{{ old('message') }}</textarea>
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
                    </div><!-- End Contact Form -->

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->


@stop
