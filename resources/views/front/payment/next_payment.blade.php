@extends('front.layouts.main')
@section('title', 'Payment Page')


@section('css')
    <style>
        .select-menu {
            max-width: 330px;
            margin: 50px auto;
        }

        .select-menu .select-btn {
            display: flex;
            height: 55px;
            background: #fff;
            padding: 20px;
            font-size: 18px;
            font-weight: 400;
            border-radius: 8px;
            align-items: center;
            cursor: pointer;
            justify-content: space-between;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .select-btn i {
            font-size: 25px;
            transition: 0.3s;
        }

        .select-menu.active .select-btn i {
            transform: rotate(-180deg);
        }

        .select-menu .options {
            position: relative;
            padding: 10px;
            margin-top: 10px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .select-menu.active .options {
            display: block;
            opacity: 0;
            animation-name: fadeInUp;
            -webkit-animation-name: fadeInUp;
            animation-duration: 0.4s;
            animation-fill-mode: both;
            -webkit-animation-duration: 0.4s;
            -webkit-animation-fill-mode: both;
        }

        .options .option {
            display: flex;
            height: 55px;
            cursor: pointer;
            padding: 0 16px;
            border-radius: 8px;
            align-items: center;
            background: #fff;
        }

        .options .option:hover {
            background: #f2f2f2;
        }

        .option i {
            font-size: 25px;
            margin-right: 12px;
        }

        .option .option-text {
            font-size: 18px;
            color: #333;
        }

        .payment-slider {
            background-color: #f3f6fc;
        }

        .payment-silder-main .testimonial-item img {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .ss-image-section {
            display: none
        }

        @keyframes fadeInUp {
            from {
                transform: translate3d(0, 30px, 0);
            }

            to {
                transform: translate3d(0, 0, 0);
                opacity: 1;
            }
        }
    </style>
    @error('payment_screenshot')
        <style>
            .payment-silder-main,
            .bank-acc-detail-main-div {
                display: block
            }
        </style>
    @enderror
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
                            <h2>Payment</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.homepage') }}">Home</a></li>
                        <li>Payment</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact payment-slider">
            <div class="container" data-aos="fade-up">
                <div class="row">

                    <div class="col-lg-12 text-center">
                        <h1 class="text-center"> Your Equated Monthly Instalment</h1>
                        <div class="select-menu ">
                            <div class="select-btn">
                                <span class="sBtn-text"> {{ $EMIAmount['emi_amount'] }}</span>
                                <i class="bx bx-chevron-down"></i>
                            </div>

                        </div>


                    </div>
                </div>
                @if ($QRCode)
                    <div class="payment-silder-main" data-aos="fade-up">
                        <div class="swiper-wrapper text-center">
                            <div class="swiper-slide">
                                <div class="testimonial-item ">
                                    <img src="{{ asset($QRCode['qrcodeimage']) }}" alt="" width="400px"
                                        height="400px">
                                    <h1 class="py-4">{{ $QRCode['upiid'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    @php $qrcodecount= count($QRCodes); @endphp
                    <div class="@if ($qrcodecount > 1) slides-1 swiper @endif payment-silder-main"
                        data-aos="fade-up">
                        <div class="swiper-wrapper text-center">
                            @foreach ($QRCodes as $QRCode)
                                <div class="swiper-slide">
                                    <div class="testimonial-item ">
                                        <img src="{{ asset($QRCode->qrcodeimage) }}" alt="" width="400px"
                                            height="400px">
                                        <h1 class="py-4">{{ $QRCode->upiid }}</h1>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @endif
                <div class="col-lg-12 my-5 m-auto bank-acc-detail-main-div">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo -->

                            <!-- /Logo -->
                            <h4 class="mb-2">Bank Account Details! 👋</h4>
                            <p class="mb-4">If UPI ID and QR Codes Not Working Then Please Use Bank Details.</p>
                            <div class="mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['bank_name'] }}"
                                    readonly>
                            </div>
                            @if($BankDetails['branch_name'])
                            <div class="mb-3">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['branch_name'] }}"
                                    readonly>
                            </div>
                            @endif
                            @if($BankDetails['branch_code'])
                            <div class="mb-3">
                                <label for="branch_code" class="form-label">Branch Code</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['branch_code'] }}"
                                    readonly>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label for="ifsc_code" class="form-label">IFSC Code</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['ifsc_code'] }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="bank_aaccount_no" class="form-label">Bank Account No.</label>
                                <input type="text" class="form-control "
                                    value="{{ $BankDetails['bank_aaccount_no'] }}" readonly>
                            </div>
                            @if($BankDetails['bank_aaccount_holder_name'])
                            <div class="mb-3">
                                <label for="bank_aaccount_holder_name" class="form-label">Bank Account Holder Name</label>
                                <input type="text" class="form-control "
                                    value="{{ $BankDetails['bank_aaccount_holder_name'] }}" readonly>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 my-5 m-auto bank-acc-detail-main-div">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Logo -->

                                    <!-- /Logo -->
                                    <h4 class="mb-2">Please Submit Your Payment Screenshot 👋</h4>
                                    <p class="mb-4">After Verify Your Payment Screenshot Password will send to your email
                                        address.</p>
                                    <form action="{{ route('front.post.next_payment') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="emi_amount" id="emi_amount"
                                            value=" {{ $EMIAmount['emi_amount'] }}">
                                        <input type="hidden" name="emi_amount_id" id="emi_amount_id"
                                            value=" {{ $EMIAmount['id'] }}">
                                        <input type="hidden" name="user_id" id="user_id"
                                            value="{{ Auth::user()->id }}">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Choose Screenshot </label>
                                            <input required accept="image/*" class="form-control" name="payment_screenshot"
                                                type="file" onchange="readURL(this)">
                                            @error('payment_screenshot')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary d-grid " type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card h-100">
                                <div class="card-body text-center d-flex align-items-center">
                                    <h1 class="ss-section-h1">Screenshot Section</h1>
                                    <img src="" class=" ss-image-section rounded" height="100%" width="100%"
                                        id="uploadedscreenshot" />
                                </div>
                            </div>
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
            $('.ss-section-h1').slideUp('fast')
            $('.ss-image-section').slideDown()
            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector("#uploadedscreenshot").setAttribute("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop
