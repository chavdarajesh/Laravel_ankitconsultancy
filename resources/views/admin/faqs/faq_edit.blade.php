@extends('admin.layouts.main')
@section('title', 'Faqs Page')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Faqs /</span> All Faqs /</span> Edit Faq</h4>

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
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.update.faq') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $Faq['id'] }}">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title"
                                        value="{{$Faq['title']}}" autofocus />
                                        @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="5" type="text" id="description" name="description"
                                        value="" >{{$Faq['description']}}</textarea>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="{{route('admin.get.faqs')}}" class="btn btn-outline-secondary">Back</a>
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
