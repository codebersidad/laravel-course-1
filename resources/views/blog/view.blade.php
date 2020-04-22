@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if($blog == null)
                <h1 class="text-center mt-5 display-1">Invalid Blog ID!</h1>
            @else
                @if($blog->feature_image != '')
                    <img src="/storage/images/{{$blog->feature_image}}" class="img-fluid">
                @endif
                <h1 class="text-center mt-5 display-3"> {{ $blog->tile }} </h1>
                <div>
                    {!! $blog->content !!}
                    
                </div>
            @endif
        </div>
    </div>
</div>
@endsection