@extends('admin.templates.base')
@section('pageTitle')
    Posts
@endsection

@section('pageMain')

    <body>
        @if (session('deletd'))
            <div class="alert alert-warning">{{ session('deletd') }}</div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="text-center">
            <h3 style="margin: 1rem">Filtra i Posts</h3>

            <form action="" method="get" class="row g-3 mb-3" style="display: inline-flex">
                <div class="col-md-6">
                    <select class="form-select" aria-label="Default select example" name="category" id="category">
                        <option value="" selected>Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $request->category) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <select class="form-select" aria-label="Default select example" name="author" id="author">
                        <option value="" selected>Select an author</option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ($user->id == $request->author) selected @endif>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row" style="display: flex; align-items: flex-end; margin-top: 1rem;">
                    <div class="col-md-9">
                        <label for="search-string" class="form-label">{{ __('Stringa di ricerca') }}</label>
                        <input type="text" class="form-control" id="search-string" name="s" value="{{ $request->s }}">
                    </div>

                    <div class="col-md-2" style="width: 9rem">
                        <button class="btn btn-primary">Applica filtri</button>
                    </div>
                </div>
            </form>

        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Text</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->tags->pluck('name')->join(', ') }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->postText }}</td>
                        <td><a href="{{ route('admin.posts.show', $post->slug) }}">Post</a></td>
                        <td>
                            @if (Auth::user()->id === $post->user_id)
                                <a href="{{ route('admin.posts.edit', $post->slug) }}">Modifica Post</a>
                            @endif
                        </td>
                        <td>
                            @if (Auth::user()->id === $post->user_id)
                                <button data-id="{{ $post->slug }}" onclick="event.stopPropagation()"
                                    class="my_btn_link btn-delete">Elimina Post</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <div class="text-center d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h2>Se continui l'elemento verrà eliminato</h2>
                <div class="d-flex justify-content-evenly mt-5">
                    <form method="POST" data-base="{{ route('admin.posts.index') }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="event.stopPropagation()" class="bg-danger text-white p-2 ">ELIMINA
                            POST</button>
                    </form>
                    <button id="btn-no" class="btn bg-primary">NO</button>
                </div>
            </div>

        </section>

    </body>

    </html>
@endsection
