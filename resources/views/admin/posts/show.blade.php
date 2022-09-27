@extends('layouts.app')

@section('content')
<div class="container">

    <header>
        <h1>{{ $post->title }}</h1>
        <div>
            @if ($post->image)
                <img class="float-left mr-2" src="{{ $post->image }}" alt="{{ $post->slug }}">
            @endif
            <p>{{ $post->content }}</p>
        </div>
        <time>Creato il: {{ $post->created_at }}</time><br>
        <time>Modificato il: {{ $post->updated_at }}</time>
    </header>
    <footer class="d-flex align-items-center justify-content-end">
        <div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                <i class="fa solid fa-rotate-left mr-2"></i> Indietro
            </a>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mx-2" type="submit">
                    <i class="fa-solid fa-trash m-2"></i>Elimina
                </button>
            </form>
        </div>
    </footer>
</div>

@endsection
