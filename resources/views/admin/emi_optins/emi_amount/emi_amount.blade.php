@extends('admin.layouts.main')
@section('title', 'EMIAmount Page')
@section('css')
    <style>
        .add-form {
            display: none;
        }
    </style>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@stop
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EMI Option /</span> EMI Amount</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active " href="javascript:void(0);"><i class='bx bxs-wallet me-1' ></i>
                            EMI
                            Amoount
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.get.qr_code') }}"><i class='bx bx-qr me-1' ></i> QR
                            Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.bankdetails') }}"><i class='bx bxs-bank me-1'></i>
                            Bank Details</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header justify-content-between d-flex">
                        <div> EMI Amount Setting </div>
                        <div><button class="btn btn-primary add-btn">Add EMI Amount</button></div>
                    </h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body add-form">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.post.emi_amount') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="emi_amount" class="form-label">EMI Amount</label>
                                    <input class="form-control" type="number" id="emi_amount" name="emi_amount"
                                        value="" autofocus />
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
                    <h5 class="card-header">All EMI Amounts</h5>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover " id="example">
                            <thead>
                                <tr>
                                    <th class="text-center" >ID</th>
                                    <th class="text-center" >EMI Amount</th>
                                    <th class="text-center" >Status</th>
                                    <th class="text-center" >Created At</th>
                                    <th class="text-center" >Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($EMIAmounts as $EMIAmount)
                                    <tr>
                                        <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $EMIAmount->id }}</strong>
                                        </td>
                                        <td class="text-center">{{ $EMIAmount->emi_amount }}</td>

                                        <td class="text-center"> <input data-id="{{ $EMIAmount->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $EMIAmount->status ? 'checked' : '' }}></td>
                                        <td class="text-center" >{{ $EMIAmount->created_at }}</td>
                                        <td class="text-center" >
                                            <a href="{{ route('admin.edit.emi_amount', $EMIAmount->id) }}"> <button
                                                    type="button" class="btn btn-success">Edit</button></a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#EMIAmount-delete-modal-{{ $EMIAmount->id }}">
                                                Delete
                                            </button>
                                            <div class="modal fade" id="EMIAmount-delete-modal-{{ $EMIAmount->id }}"
                                                tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalCenterTitle">Delete Item
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.delete.emi_amount', $EMIAmount->id) }}"
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
                "order": [[ 0, 'desc' ]]
            });
        });
        $('.add-btn').click(function() {
            $('.add-form').slideToggle('slow');
        })
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.emi_amount.status') }}',
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
