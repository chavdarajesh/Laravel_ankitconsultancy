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

        .payment-silder-main,
        .bank-acc-detail-main-div,
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
                        <h1 class="text-center">Select Your Equated Monthly Instalment</h1>
                        <div class="select-menu active">
                            <div class="select-btn">
                                <span class="sBtn-text">Select your option</span>
                                <i class="bx bx-chevron-down"></i>
                            </div>
                            <ul class="options">
                                @foreach ($EMIAmounts as $EMIAmount)
                                    <li class="option">
                                        <i class="bx bxl-instagram-alt" style="color: #E1306C;"></i>
                                        <span class="option-text" id="option-emi-amount">
                                            {{ $EMIAmount->emi_amount }}</span>
                                        <input type="hidden" id="option-emi-id" value="{{ $EMIAmount->id }}">
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
                @php $qrcodecount= count($QRCodes); @endphp
                <div class="@if($qrcodecount > 1)  slides-1 swiper  @endif payment-silder-main" data-aos="fade-up">
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
                <div class="col-lg-12 my-5 m-auto bank-acc-detail-main-div">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo -->

                            <!-- /Logo -->
                            <h4 class="mb-2">Bank Account Details! 👋</h4>
                            <p class="mb-4">if UPI ID and QR Codes Not Working Then Please Use Bank Details.</p>
                            <div class="mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['bank_name'] }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['branch_name'] }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="branch_code" class="form-label">Branch Code</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['branch_code'] }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="ifsc_code" class="form-label">IFSC Code</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['ifsc_code'] }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="bank_aaccount_no" class="form-label">Bank Account No.</label>
                                <input type="text" class="form-control " value="{{ $BankDetails['bank_aaccount_no'] }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="bank_aaccount_holder_name" class="form-label">Bank Account Holder Name</label>
                                <input type="text" class="form-control "
                                    value="{{ $BankDetails['bank_aaccount_holder_name'] }}" readonly>
                            </div>
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
                                    <p class="mb-4">After Verfiy Your Pyament Screenshot Paasword will send to your email
                                        address.</p>
                                    <form action="{{ route('front.post.first_payment') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="emi_amount" id="emi_amount" value="">
                                        <input type="hidden" name="emi_amount_id" id="emi_amount_id" value="">
                                        <input type="hidden" name="user_id" id="user_id"
                                            value="{{ Auth::user()->id }}">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Choose Scrrenshot </label>
                                            <input accept="image/*" class="form-control" name="payment_screenshot"
                                                type="file" onchange="readURL(this)">
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
                                    <h1 class="ss-section-h1">ScrrenShot Section</h1>
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
        const optionMenu = document.querySelector(".select-menu"),
            selectBtn = optionMenu.querySelector(".select-btn"),
            options = optionMenu.querySelectorAll(".option"),
            sBtn_text = optionMenu.querySelector(".sBtn-text");

        selectBtn.addEventListener("click", () =>
            optionMenu.classList.toggle("active")
        );

        options.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOption = option.querySelector("#option-emi-amount").innerText;
                let selectedOption_id = option.querySelector("#option-emi-id").value;
                sBtn_text.innerText = selectedOption;

                optionMenu.classList.remove("active");
                $('#emi_amount').val(selectedOption);
                $('#emi_amount_id').val(selectedOption_id);
                $('.payment-silder-main,.bank-acc-detail-main-div').slideDown('slow')
            });
        });

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
