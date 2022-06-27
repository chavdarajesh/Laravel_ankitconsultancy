@extends('front.layouts.main')
@section('title', 'Profile Page')
@section('css')
    <style>
        .payment-slider {
            background-color: #f3f6fc;
        }

        .password_setting {
            display: none;
        }
    </style>
     @error('oldpassword') <style> .password_setting { display: block; } .profile_setting{ display: none; } </style> @enderror
     @error('newpassword') <style> .password_setting { display: block; } .profile_setting{ display: none; } </style> @enderror
     @error('confirmnewpasswod') <style> .password_setting { display: block; } .profile_setting{ display: none; } </style> @enderror
@stop
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('assets/front/img/page-header.jpg') }}');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Profile</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>Profile</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact payment-slider">
            <div class="container" data-aos="fade-up">
                <div class="col-lg-9 my-5 m-auto bank-acc-detail-main-div">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo -->
                            <form action="{{ route('front.post.profilepage') }}" method="post"
                                enctype="multipart/form-data">
                                <!-- /Logo -->
                                @csrf
                                <div class="row p-3 border-bottom shadow-lg p-3 mb-5 bg-white rounded ">
                                    <div class="col-lg-3 p-2">
                                        <img src="{{ Auth::user()->profileimage ? asset(Auth::user()->profileimage) : asset('assets/admin/img/avatars/1.png') }}"
                                            alt="user-avatar" class="d-block rounded" width="200px" height="200px"
                                            id="uploadedAvatar" />
                                    </div>
                                    <div class="col-lg-8">
                                        <h4 class="mb-2">Hi! {{ Auth::user()->name }} 👋</h4>
                                        <hr>
                                        <h4 class="mb-2">Your Email Is - {{ Auth::user()->email }}</h4>
                                        <hr>
                                        <h4 class="mb-2">Your Username Is - {{ Auth::user()->username }}</h4>
                                        <hr>
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-sm-block">Upload new photo</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" id="upload" class="account-file-input profilephoto"
                                                    hidden accept="image/png, image/jpeg" name="profilephoto"
                                                    onchange="readURL(this)" />
                                            </label>
                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row profile_setting">
                                    <h3 class="my-3">Profile Setting</h3>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input required type="text" class="form-control @error('name') is-invalid @enderror "
                                            id="name" value="{{ Auth::user()->name }}" name="name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input required type="text" class="form-control @error('username') is-invalid @enderror "
                                            id="username" value="{{ Auth::user()->username }}" name="username">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input required type="email" class="form-control @error('email') is-invalid @enderror "
                                            id="email" value="{{ Auth::user()->email }}" name="email">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input required type="tel" class="form-control @error('phone') is-invalid @enderror "
                                            id="phone" maxlength="10" value="{{ Auth::user()->phone }}"
                                            name="phone">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea required name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ Auth::user()->address }}</textarea>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateofbirth" class="form-label">Date Of Birth</label>
                                        <input required type="date"
                                            class="form-control @error('dateofbirth') is-invalid @enderror "
                                            value="{{ Auth::user()->dateofbirth }}" id="dateofbirth" name="dateofbirth"
                                            max="2022-06-16">
                                        @error('dateofbirth')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid " type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('front.post.profile.changepassword') }}" method="post">
                                @csrf
                                <div class="row password_setting">
                                    <h3 class="my-3">Password Setting</h3>
                                    <div class="mb-3">
                                        <label for="oldpassword" class="form-label">Old Password</label>
                                        <input required type="text" class="form-control @error('oldpassword') is-invalid @enderror" id="oldpassword" value="{{ old('oldpassword') }}"
                                            name="oldpassword">
                                            @error('oldpassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="newpassword" class="form-label">New Password</label>
                                        <input required type="text" class="form-control @error('newpassword') is-invalid @enderror" id="newpassword" value="{{ old('newpassword') }}"
                                            name="newpassword">
                                            @error('newpassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmnewpasswod" class="form-label">Confirm New Password</label>
                                        <input required type="text" class="form-control @error('confirmnewpasswod') is-invalid @enderror" id="confirmnewpasswod"
                                            value="{{ old('confirmnewpasswod') }}" name="confirmnewpasswod">
                                            @error('confirmnewpasswod')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid " type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>

                            <p class="profile_setting">
                                <span>Password Setting?</span>
                                <a href="" class="click_here_profile cursor-pointer">Click Here</a>
                            </p>
                            <p class="password_setting">
                                <span>Profile Setting?</span>
                                <a href="" class="click_here_password cursor-pointer">Click Here</a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </section>


    </main>


@stop
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector("#uploadedAvatar").setAttribute("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        dateofbirth.max = new Date().toISOString().split("T")[0];
        $('.click_here_profile').click(function(event) {
            event.preventDefault();
            $('.profile_setting').slideUp();
            $('.password_setting').slideDown();
        });
        $('.click_here_password').click(function(event) {
            event.preventDefault();
            $('.profile_setting').slideDown();
            $('.password_setting').slideUp();
        });
    </script>
@stop
