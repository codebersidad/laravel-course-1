@extends('layouts.main')

@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row row-cols-1 row-cols-md-3">
            @if(count($blogs) > 0)
                @foreach($blogs as $blog)
                <div class="col mb-4">
                    <div class="card">
                        @if($blog->feature_image != '')
                            <img src="/storage/images/{{$blog->feature_image}}" class="img-fluid" />
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"> {{ $blog->title }} </h5>
                            <p class="card-text"> {{ substr(strip_tags($blog->content), 0 , 150) }}</p>
                            <a href="/blog/{{$blog->id}}" class="btn btn-primary">Read More...</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
            {{ $blogs->links() }}
        </div>
    </div>

    
</div>
@endsection