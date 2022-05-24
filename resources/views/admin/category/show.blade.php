@extends('admin.templates.base')
@section('pageTitle', $category->name)

@section('pageMain')
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="card m-5" style="width: 32rem;">
            <div class="card-body" style="text-align:center;">
                <span class="m-4">Categoria:</span>
                <h3 class="card-title text-uppercase d-inline-block">{{ $category->name }}</h3>
                <h5 class="card-title m-4">Descrizione: {{ $category->descrption }}</h5>
                {{-- @if (Auth::user()->id === $category->user_id) --}}
                <a class="tasto_show bg-green mt-3" href="{{ route('admin.categories.edit', $category->id) }}">Modifica
                    categoria</a>
                {{-- @endif --}}

                {{-- @if (Auth::user()->id === $category->user_id) --}}
                <button data-id="{{ $category->id }}" onclick="event.stopPropagation()"
                    class="btn-delete bg-danger text-white p-1 mt-4">ELIMINA
                    CATEGORIA</button>
                {{-- @endif --}}
            </div>
        </div>

        <div class="d-flex">
            <div class="m-5">
                <a class="text-white bg-black p-2" href="{{ url()->previous() }}">Torna indietro</a>
            </div>
            <div class="m-5">
                <a class="text-white bg-black p-2"
                    href="{{ route('admin.categories.index', 'CategoryController') }}">Torna
                    alla
                    lista</a>
            </div>
            {{-- @if (Auth::user()->id === $post->user_id) --}}
            <div class="m-5">
                <a class="text-white bg-black p-2" href="{{ route('admin.myposts') }}">Torna
                    ai miei Posts</a>
            </div>
            {{-- @endif --}}
        </div>

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


    </div>
@endsection
