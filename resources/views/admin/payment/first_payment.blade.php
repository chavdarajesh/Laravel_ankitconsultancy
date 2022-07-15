@extends('admin.layouts.main')
@section('title', 'Payment Page')
@section('css')
    <style>
        .add-form {
            display: none;
        }

        .switch_payment_verified,.switch_payment_not_verified {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch_payment_verified input,.switch_payment_not_verified input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider_payment_verified,.slider_payment_not_verified {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider_payment_verified{
            background-color: #71dd37;

        }
        .slider_payment_not_verified{
            background-color: #ff3e1d;

        }

        .slider_payment_verified:before ,.slider_payment_not_verified:before{
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider_payment_verified:before{
            background-color: white;
        }
        .slider_payment_not_verified:before{
            background-color: white;
        }
        input:checked+.slider_payment_verified {
            background-color: #2a7800;
        }
        input:checked+.slider_payment_not_verified{
            background-color: #8d1905;
        }

        input:focus+.slider_payment_verified  {
            box-shadow: 0 0 1px #81f542;
        }
        input:focus+.slider_payment_not_verified {
            box-shadow: 0 0 1px #ff3e1d;
        }

        input:checked+.slider_payment_verified:before ,  input:checked+.slider_payment_not_verified:before{
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider_payment_verified.round ,.slider_payment_not_verified.round{
            border-radius: 34px;
        }

        .slider_payment_verified.round:before ,.slider_payment_not_verified.round:before{
            border-radius: 50%;
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
                        <a class="nav-link" href="{{ route('admin.get.not_verified_payment') }}"><i
                                class='bx bx-credit-card me-1'></i>
                            Not Verified Payment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.get.all_payment') }}"><i
                                class='bx bx-credit-card me-1'></i>
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
                                        <td class="text-center">{{ @User::get_user_by_id($Payment->user_id)->name ? @User::get_user_by_id($Payment->user_id)->name : 'User Deleted' }}</td>
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
                                                            <h5 class="modal-title" id="modalFullTitle">Amount :
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
                                        <td class="text-center">
                                            <label class="switch_payment_verified">
                                                <input type="checkbox" class="payment_verified" data-id="{{ $Payment->id }}" {{ $Payment->is_verified ? 'checked disabled' : '' }} {{ @User::get_user_by_id($Payment->user_id)->name ? '' : 'disabled' }}>
                                                <span class="slider_payment_verified round"></span>
                                            </label>
                                            <label class="switch_payment_not_verified">
                                                <input type="checkbox"  class="payment_not_verified" data-id="{{ $Payment->id }}" {{ $Payment->is_not_verified ? 'checked' : '' }} {{ $Payment->is_verified ? 'disabled' : '' }} {{ @User::get_user_by_id($Payment->user_id)->name ? '' : 'disabled' }}>
                                                <span class="slider_payment_not_verified round"></span>
                                            </label>
                                        </td>
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
                "order": [
                    [0, 'desc']
                ]
            });
        });
        $(function() {
            $('.payment_verified').change(function() {
                $(this).prop('disabled', true)
                $('.payment_not_verified').prop('disabled', true)
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
            $('.payment_not_verified').change(function() {
                $(this).prop('disabled', true)
                var is_verified = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.update.first_payment.is_not_verified') }}',
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
