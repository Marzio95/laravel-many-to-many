@extends('admin.templates.base')
@section('pageTitle')
    Posts
@endsection

@section('pageMain')

    <body>
        <div class="text-center m-5"><a href="{{ route('admin.categories.create') }}">Create Category</a></div>
        @if (session('deletd'))
            <div class="alert alert-warning">{{ session('deletd') }}</div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td><a href="{{ route('admin.categories.show', $category->id) }}">Category</a></td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}">Modifica category</a>
                        </td>
                        <td>
                            <button data-id="{{ $category->id }}" onclick="event.stopPropagation()"
                                class="my_btn_link btn-delete">Elimina category</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h2>Se continui l'elemento verrà eliminato</h2>
                <div class="d-flex justify-content-evenly mt-5">
                    <form method="POST" data-base="{{ route('admin.categories.index') }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="event.stopPropagation()" class="bg-danger text-white p-2 ">ELIMINA
                            CATEGORIA</button>
                    </form>
                    <button id="btn-no" class="btn bg-primary">NO</button>
                </div>
            </div>

        </section>

    </body>

    </html>
@endsection
