@extends('admin.templates.base')
@section('pageTitle')
    Create Post
@endsection


@section('pageMain')
    <form class="m-auto w-75 mt-4" method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input value="{{ old('name') }}" type="text" class="form-control" id="name" placeholder="Name"
                    name="name">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mt-3 mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input value="{{ old('description') }}" type="text" class="form-control" id="Description"
                    placeholder="description" name="description">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- <div class="form-group row mt-3 mb-3">
            <div class="col-4">
                <input class="btn-slugger" type="button" value="Genera il tuo slug">
            </div>
        </div> --}}





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
