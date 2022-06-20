@extends('admin.layouts.main')
@section('title', 'Bank Details Page')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EMI Option /</span> Bank Details</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.emi_option') }}"><i class="bx bx-user me-1"></i> EMI
                            Amoount
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.qr_code') }}"><i class="bx bx-bell me-1"></i> QR
                            Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-bell me-1"></i> Bank
                            Details</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Bank Details</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.post.bankdetails') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $BankDetails ? $BankDetails['id'] : 1 }}">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input class="form-control @error('bank_name') is-invalid @enderror" type="text"
                                        id="bank_name" name="bank_name"
                                        value="{{ $BankDetails ? $BankDetails['bank_name'] : old('bank_name') }}"
                                        autofocus />
                                    @error('bank_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="branch_name" class="form-label">Brach Name</label>
                                    <input class="form-control @error('branch_name') is-invalid @enderror" type="text"
                                        id="branch_name" name="branch_name"
                                        value="{{ $BankDetails ? $BankDetails['branch_name'] : old('branch_name') }}"
                                        autofocus />
                                    @error('branch_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="branch_code" class="form-label">Branch Code</label>
                                    <input class="form-control @error('branch_code') is-invalid @enderror" type="text"
                                        id="branch_code" name="branch_code"
                                        value="{{ $BankDetails ? $BankDetails['branch_code'] : old('branch_code') }}"
                                        autofocus />
                                    @error('branch_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                    <input class="form-control @error('ifsc_code') is-invalid @enderror" type="text"
                                        id="ifsc_code" name="ifsc_code"
                                        value="{{ $BankDetails ? $BankDetails['ifsc_code'] : old('ifsc_code') }}"
                                        autofocus />
                                    @error('ifsc_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="bank_aaccount_no" class="form-label">Bank Account No.</label>
                                    <input class="form-control @error('bank_aaccount_no') is-invalid @enderror"
                                        type="text" id="bank_aaccount_no" name="bank_aaccount_no"
                                        value="{{ $BankDetails ? $BankDetails['bank_aaccount_no'] : old('bank_aaccount_no') }}"
                                        autofocus />
                                    @error('bank_aaccount_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="bank_aaccount_holder_name" class="form-label">Bank Account Holder
                                        Name</label>
                                    <input class="form-control @error('bank_aaccount_holder_name') is-invalid @enderror"
                                        type="text" id="bank_aaccount_holder_name" name="bank_aaccount_holder_name"
                                        value="{{ $BankDetails ? $BankDetails['bank_aaccount_holder_name'] : old('bank_aaccount_holder_name') }}"
                                        autofocus />
                                    @error('bank_aaccount_holder_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@stop
