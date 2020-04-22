@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('post-saved'))
            <div class="alert alert-success" role="alert">
                {{ session('post-saved') }}
            </div>
            @endif
            @if(session('post-failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('post-failed') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-light bg-light justify-content-between">
                        <a class="navbar-brand">Dashboard</a>
                        <form method="GET" action="{{ url('/blog/create/') }}" class="form-inline">
                            @csrf
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Create New</button>
                        </form>
                    </nav>
                </div>
                <div class="card-body">
                    @if(count($blogs) > 0) 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <th scope="row"> {{ $blog->id }}</th>
                                <td>{{ $blog->title }}</td>
                                <td><a class="btn btn-outline-primary" href="/blog/{{$blog->id}}"> View</a></td>
                                <td><a class="btn btn-outline-secondary" href="/blog/{{$blog->id}}/edit"> Edit</a></td>
                                <td>
                                    <form method="POST" action="/blog/{{$blog->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection