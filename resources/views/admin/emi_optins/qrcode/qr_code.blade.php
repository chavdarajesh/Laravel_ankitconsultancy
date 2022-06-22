@extends('admin.layouts.main')
@section('title', 'QR Code Page')
@section('css')
    <style>
        .add-form {
            display: none;
        }
    </style>
    @error('adminupiid')
        <style>
            .add-form {
                display: block;
            }
        </style>
    @enderror
    @error('adminqrcodeimage')
        <style>
            .add-form {
                display: block;
            }
        </style>
    @enderror

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@stop
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EMI Option /</span> QR Code</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.get.emi_option') }}"><i class='bx bxs-wallet me-1'></i>
                            EMI
                            Amoount
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class='bx bx-qr me-1'></i> QR Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.bankdetails') }}"><i class='bx bxs-bank me-1'></i>
                            Bank Details</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header justify-content-between d-flex">
                        <div> QR Code Setting </div>
                        <div><button class="btn btn-primary add-btn">Add QR Code</button></div>
                    </h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body add-form">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.post.qr_code') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('assets/admin/img/custom/qr-code-svgrepo-com.svg') }}"
                                        alt="user-avatar" class="d-block rounded @error('adminupiid') border border-danger @enderror" height="100" width="100"
                                        id="uploadedAvatar" />
                                    <div id="dvPreview">
                                    </div>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input adminqrcodeimage"
                                                hidden accept="image/png, image/jpeg" name="adminqrcodeimage"
                                                value="{{ old('adminqrcodeimage') }}" onchange="readURL(this)" />
                                        </label>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        @error('adminqrcodeimage')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="adminupiid" class="form-label">UPI ID</label>
                                    <input class="form-control @error('adminupiid') is-invalid @enderror" type="text"
                                        id="adminupiid" name="adminupiid" value="{{ old('adminupiid') }}" autofocus />
                                    @error('adminupiid')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">All QR Codes</h5>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover " id="example">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">UPI ID</th>
                                    <th class="text-center">QR Image</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($QRCodes as $QRCode)
                                    <tr>
                                        <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $QRCode->id }}</strong>
                                        </td>
                                        <td class="text-center">{{ $QRCode->upiid }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset($QRCode->qrcodeimage) }}"
                                                alt="{{ asset($QRCode->qrcodeimage) }}" width="40px" height="40px"
                                                data-bs-toggle="modal"
                                                data-bs-target="#fullscreenModal-{{ $QRCode->id }}"
                                                class="cursor-pointer">

                                            <div class="modal fade" id="fullscreenModal-{{ $QRCode->id }}" tabindex="-1"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-fullscreen" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">UPI ID :
                                                                {{ $QRCode->upiid }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset($QRCode->qrcodeimage) }}"
                                                                alt="{{ asset($QRCode->qrcodeimage) }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center"> <input data-id="{{ $QRCode->id }}"
                                                class="toggle-class" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $QRCode->status ? 'checked' : '' }}></td>
                                        <td class="text-center">{{ $QRCode->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.edit.qr_code', $QRCode->id) }}"> <button
                                                    type="button" class="btn btn-success">Edit</button></a>

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#qrcode-delete-modal-{{ $QRCode->id }}">
                                                Delete
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="qrcode-delete-modal-{{ $QRCode->id }}"
                                                tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalCenterTitle">Delete Item
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.delete.qr_code', $QRCode->id) }}"
                                                                method="post">
                                                                <h3>Do You Want To Really Delete This Item?</h3>
                                                                @csrf
                                                                @method('DELETE')
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, 'desc']
                ]
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector("#uploadedAvatar").setAttribute("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $('.add-btn').click(function() {
            $('.add-form').slideToggle('slow');
        })
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.qr_code.status') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success(data.success);
                        }
                        if (data.error) {
                            toastr.error(data.error);
                        }
                    }
                });
            })
        })
    </script>
@stop
