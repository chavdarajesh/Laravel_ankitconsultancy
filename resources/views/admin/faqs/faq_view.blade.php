@extends('admin.layouts.main')
@section('title', 'Faqs Page')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Faqs /</span> All Faqs /</span> View Faq</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.get.faqs')}}"><i class='bx bx-qr me-1' ></i> All Faqs</a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Faqs Setting</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                            <input type="hidden" name="id" value="{{ $Faq['id'] }}">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" readonly id="title" name="title"
                                        value="{{$Faq['title']}}" autofocus />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" rows="5" type="text" readonly id="description" name="description"
                                        value="" >{{$Faq['description']}}</textarea>
                                </div>
                                <div class="mt-2">
                                    <a href="{{route('admin.get.faqs')}}" class="btn btn-outline-secondary">Back</a>
                                </div>
                            </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@stop
