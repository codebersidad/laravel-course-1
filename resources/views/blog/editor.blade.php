@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-light bg-light justify-content-between">
                        <a class="navbar-brand"> {{ $title }} </a>
                        <form method="GET" action="{{ url('blog') }}" class="form-inline">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Cancel</button>
                        </form>
                    </nav>
                </div>
                <div class="card-body">
                    @isset($blog->feature_image)
                        @if($blog->feature_image != '')
                            <img src="/storage/images/{{$blog->feature_image}}" class="card-img-top mb-3">
                        @endif
                    @endisset
                    <form method="POST" action="{{ url('/blog') }}/{{ $blog->id ?? '' }}" enctype="multipart/form-data">
                        @isset($blog->id)
                            @method('PUT')
                        @endisset
                        @csrf
                        <div class="form-group">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" name="title" value="{{ $blog->title ?? '' }}" class="form-control" id="FormControlTitle" placeholder="Title">
                        </div>
                            @error('featureImage')
                            <div class="alert alert-danger mb-2">{{ $message }}</div>
                            @enderror
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="featureImage" name="featureImage">
                            <label class="custom-file-label" for="featureImage">Choose Feature Image</label>
                        </div>
                        <div class="form-group">
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <textarea name="content" class="form-control form-control-lg" id="FormControlText" rows="3">{{ $blog->content ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection