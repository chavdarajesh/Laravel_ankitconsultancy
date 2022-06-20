@extends('admin.layouts.main')
@section('title', 'QR Code Page')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EMI Option /</span> QR Code /</span> QR Code Edit</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.get.emi_option') }}"><i class="bx bx-user me-1"></i> EMI
                            Amoount
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-bell me-1"></i> QR Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.bankdetails') }}"><i class="bx bx-bell me-1"></i>
                            Bank Details</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">QR Code Setting</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.update.qr_code') }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $QRCode['id'] }}">
                            <div class="row mb-3">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $QRCode['qrcodeimage'] ? asset($QRCode['qrcodeimage']) : asset('assets/admin/img/custom/qr-code-svgrepo-com.svg') }}"
                                        alt="user-avatar" class="d-block rounded" height="100" width="100"
                                        id="uploadedAvatar" />
                                    <div id="dvPreview">
                                    </div>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input adminqrcodeimage"
                                                hidden accept="image/png, image/jpeg" name="adminqrcodeimage"
                                                onchange="readURL(this)" />
                                        </label>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="adminupiid" class="form-label">UPI ID</label>
                                    <input class="form-control" type="text" id="adminupiid" name="adminupiid"
                                        value="{{ $QRCode['upiid'] }}" autofocus />
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Update changes</button>
                                    <a href="{{ route('admin.get.qr_code') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
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
    </script>
@stop
