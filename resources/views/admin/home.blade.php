@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-evenly">
            <a class="mybtn_list" href="{{ route('admin.posts.index') }}">Listing Posts</a>
            <a class="mybtn_list bg-primary" href="{{ route('admin.posts.create') }}">Create Post</a>
            <a class="mybtn_list bg-danger" href="{{ route('admin.myposts') }}">My Posts</a>

        </div>
    </div>
@endsection
