@extends('front.layouts.main')
@section('title', 'Login')
@section('content')

    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Login</h2>
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
                        <li>Login</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="get-a-quote" class="get-a-quote">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <!-- Logo -->

                                <!-- /Logo -->
                                <h4 class="mb-2">Welcome to Financial Advisory 👋</h4>
                                <p class="mb-4">Please sign-in to your account and start the adventure</p>

                                <form id="formAuthentication" class="mb-3" action="{{ route('front.post.login') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email or Username<span class="text-danger">*</span></label>
                                        <input type="email" value="" class="form-control " id="email"
                                            name="email" placeholder="Enter your email or username" autofocus required />

                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="adminpassword">Password<span class="text-danger">*</span></label>
                                            <a href="{{ route('front.forgotpassword') }}">
                                                <small>Forgot Password?</small>
                                            </a>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" value="" class="form-control "
                                                name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" required/>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="accept_t_c" name="accept_t_c" required/>
                                            <label class="form-check-label" for="accept_t_c">I agree to the <a target="_blank" href="{{route('front.term_and_conditionpage')}}">Terms and Conditions</a> and <a target="_blank"  href="{{route('front.privacy_policypage')}}">Privacy Policy</a>.<span class="text-danger">*</span> </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                                    </div>
                                </form>

                                <p class="text-center">
                                    <span>New on our platform?</span>
                                    <a href="{{ route('front.register') }}">
                                        <span>Create an account</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="authentication-wrapper authentication-basic container-p-y">
                    <div class="authentication-inner">
                        <!-- Register -->

                        <!-- /Register -->
                    </div>
                </div>
            </div>
        </section>

    </main>
@stop
