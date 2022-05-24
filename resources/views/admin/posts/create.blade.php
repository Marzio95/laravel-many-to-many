@extends('admin.templates.base')
@section('pageTitle')
    Create Post
@endsection


@section('pageMain')
    <form class="m-auto w-75 mt-4" method="POST" action="{{ route('admin.posts.store') }}">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input value="{{ old('title') }}" type="text" class="form-control" id="title" placeholder="Title"
                    name="title">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mt-3 mb-3">
            <label for="slug" class="col-sm-2 col-form-label">Slug</label>
            <div class="col-sm-10">
                <input value="{{ old('slug') }}" type="text" class="form-control" id="slug" placeholder="Slug"
                    name="slug">
                @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mt-3 mb-3">
            <div class="col-4">
                <input class="btn-slugger" type="button" value="Genera il tuo slug">
            </div>
        </div>

        <select class="mt-3 mb-3" name="category_id" id="category_id">
            <option selected value="">Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <fieldset class="mb-5">
            <legend>Tags</legend>
            @foreach ($tags as $tag)
                <input @if (in_array($tag->id, old('tags', []))) checked @endif type="checkbox" name="tags[]"
                    id="tag-{{ $tag->id }}" value="{{ $tag->id }}">
                <label for="tag {{ $tag->id }}">{{ $tag->name }}</label>
            @endforeach
        </fieldset>


        <div class="form-group row">
            <label for="postText" class="col-sm-2 col-form-label">Testo del post</label>
            <div class="col-sm-10">
                <input value="{{ old('postText') }}" type="text" class="form-control" id="postText"
                    placeholder="Testo del post" name="postText">
                @error('postText')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row m-5 d-flex">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
            <div class="col-sm-10 mt-5">
                <a class="text-white bg-black p-2" href="{{ url()->previous() }}">Torna alla lista</a>
            </div>
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
