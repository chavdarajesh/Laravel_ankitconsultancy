@extends('admin.layouts.main')
@section('title', 'EMIAmount Page')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EMI Option /</span> QR Code /</span> EMIAmount Edit
        </h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> EMI
                            Amoount
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.get.qr_code') }}"><i class="bx bx-bell me-1"></i> QR
                            Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.bankdetails') }}"><i class="bx bx-bell me-1"></i>
                            Bank Details</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">EMIAmount Setting</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.update.emi_amount') }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $EMIAmount['id'] }}">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="emi_amount" class="form-label">EMI Amount</label>
                                    <input class="form-control" type="number" id="emi_amount" name="emi_amount"
                                        value="{{ $EMIAmount['emi_amount'] }}" autofocus />
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Update changes</button>
                                    <a href="{{ route('admin.get.emi_amount') }}"
                                        class="btn btn-outline-secondary">Cancel</a>
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
