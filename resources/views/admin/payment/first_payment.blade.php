@extends('admin.layouts.main')
@section('title', 'Payment Page')
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
    @php
    use App\Models\User;
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Payment /</span> First Payment</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active " href="javascript:void(0);"><i class='bx bx-credit-card me-1'></i>
                            First Payment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.get.not_verified_payment')}}"><i class='bx bx-credit-card me-1'></i>
                            Not Verified Payment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('admin.get.all_payment')}}"><i class='bx bx-credit-card me-1'></i>
                            All Payment
                        </a>
                    </li>

                </ul>
                <div class="card">
                    <h5 class="card-header">All First Payment</h5>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover " id="example">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">EMI Amount</th>
                                    <th class="text-center">User Name</th>
                                    <th class="text-center">Payment Screenshot</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Is verified</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($Payments as $Payment)
                                    <tr>
                                        <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $Payment->id }}</strong>
                                        </td>
                                        <td class="text-center">{{ $Payment->emi_amount }}</td>
                                        <td class="text-center">{{ User::get_user_by_id($Payment->user_id)->name }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset($Payment->payment_screenshot) }}"
                                                alt="{{ asset($Payment->payment_screenshot) }}" width="40px"
                                                height="40px" data-bs-toggle="modal"
                                                data-bs-target="#fullscreenModal-{{ $Payment->id }}"
                                                class="cursor-pointer">

                                            <div class="modal fade" id="fullscreenModal-{{ $Payment->id }}" tabindex="-1"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-fullscreen" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">Amounnt :
                                                                {{ $Payment->emi_amount }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset($Payment->payment_screenshot) }}"
                                                                alt="{{ asset($Payment->payment_screenshot) }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center"> <input data-id="{{ $Payment->id }}"
                                                class="payment_status" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $Payment->status ? 'checked' : '' }}></td>
                                        <td class="text-center"> <input data-id="{{ $Payment->id }}"
                                                class="payment_verified" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Verified"
                                                data-off="Not Verified"
                                                {{ $Payment->is_verified ? 'checked disabled' : '' }}></td>
                                        <td class="text-center">{{ $Payment->created_at }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-icon btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#payment-delete-modal-{{ $Payment->id }}">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>
                                            <div class="modal fade" id="payment-delete-modal-{{ $Payment->id }}"
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
                                                                action="{{ route('admin.delete.first_payment', $Payment->id) }}"
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
        $(function() {
            $('.payment_verified').change(function() {
                $(this).prop('disabled',true)
                var is_verified = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.first_payment.is_verified') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'is_verified': is_verified,
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




            $('.payment_status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.first_payment.status') }}',
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
