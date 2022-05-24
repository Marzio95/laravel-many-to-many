@extends('admin.templates.base')
@section('pageTitle')
    Create Post
@endsection



@section('pageMain')
    <form class="m-auto w-75 mt-4" method="POST" action="{{ route('admin.posts.update', $post->slug) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input value="{{ old('title', $post->title) }}" type="text" class="form-control" id="title"
                    placeholder="Title" name="title">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mt-3 mb-3">
            <label for="slug" class="col-sm-2 col-form-label">slug</label>
            <div class="col-sm-10">
                <input value="{{ old('slug', $post->slug) }}" type="text" class="form-control" id="slug"
                    placeholder="slug" name="slug">
                @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="postText" class="col-sm-2 col-form-label">Text</label>
            <div class="col-sm-10">
                <input value="{{ old('postText', $post->postText) }}" type="text" class="form-control" id="postText"
                    placeholder="Testo del post" name="postText">
                @error('postText')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">MODIFICA POST</button>
        </div>
        <div class="col-sm-10 mt-5">
            <a class="text-white bg-black p-2" href="{{ url()->previous() }}">Torna indietro</a>
        </div>
        <div class="col-sm-10 mt-5">
            <a class="text-white bg-black p-2" href="{{ route('admin.posts.index', 'PostController') }}">Torna alla
                lista</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
@endsection
