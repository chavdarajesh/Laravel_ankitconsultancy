@extends('admin.layouts.main')
@section('title', 'Bank Details Page')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Contact /</span> Contact Settings</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.get.contact_msg') }}"><i class='bx bxs-contact me-1'></i>
                            Contact Message
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  " href="{{ route('admin.get.contact_settings') }}"><i
                                class='bx bxs-contact me-1'></i>
                            Contact Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " href="javascript:void(0);"><i class='bx bxs-contact me-1'></i>
                            Home Settings
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Home Settings</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{route('admin.post.home_settings')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id"
                                value="{{ $ContactSetting ? $ContactSetting['id'] : 1 }}">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Home Page Video</label>
                                    <input accept=" video/*" class="form-control @error('home_page_video') is-invalid @enderror"
                                        type="file" id="home_page_video" name="home_page_video" autofocus>
                                    @error('home_page_video')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <video controls autoplay muted height="500px" src="{{ $ContactSetting['home_page_video'] ? asset($ContactSetting['home_page_video']) : old('home_page_video') }}"></video>
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
