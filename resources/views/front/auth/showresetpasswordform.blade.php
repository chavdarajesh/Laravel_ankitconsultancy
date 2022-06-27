@extends('front.layouts.main')
@section('title', 'Forgot Password')
@section('content')

    <main id="main">


        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Forgot Password</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>Forgot Password</li>
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
                                <h4 class="mb-2">Welcome to FINANCIAL ADVISOR 👋</h4>
                                <h4 class="mb-2">Reset Password!</h4>
                                <p class="mb-4">Enter New Password and Confirm Password to Continue!..</p>

                                <form id="formAuthentication" class="mb-3"
                                    action="{{ route('front.reset.password.post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="mb-3 form-password-toggle">
                                        <label for="newpassword" class="form-label">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input required type="password" id="newpassword" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password"  value="{{old('newpassword')}}"/>
                                        </div>
                                        @error('newpassword')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <label for="confirmnewpasswod" class="form-label">New Conform Password</label>
                                        <div class="input-group input-group-merge">
                                            <input required type="password" id="confirmnewpasswod" class="form-control @error('confirmnewpasswod') is-invalid @enderror"
                                                name="confirmnewpasswod"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password"  value="{{old('confirmnewpasswod')}}" />
                                        </div>
                                        @error('confirmnewpasswod')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Save Password</button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <a href="{{ route('front.login') }}"
                                        class="d-flex align-items-center justify-content-center">
                                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                        Back to login
                                    </a>
                                </div>
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
