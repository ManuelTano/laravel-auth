@extends('layouts.app')

@section('content')
    <a href=" {{ route('admin.posts.create') }}" class="btn btn-success text-white">
        <i class="fa-solid fa-plus "><span class="mx-2">Nuovo</span></i></a>
    <table class="table table-striped table-dark border-1 mt-4">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Autore</th>
                <th scope="col">Tags</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato il </th>
                <th scope="col">Modificato il </th>
                <th>Bottoni</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if ($post->category)
                            <span class="badge badge-pill badge-{{ $post->category->color ?? 'light' }}">
                                {{ $post->category->label }}</span>
                        @else
                            Nessuna
                        @endif
                    </td>
                    <td>
                        @if ($post->user)
                            {{ $post->user->name }}
                        @else
                            Autore anonimo
                        @endif
                    </td>
                    <td>
                        <div class="mb-2">
                            @forelse($post->tags as $tag)
                                <span class="badge text-white p-1"
                                    style="background-color: {{ $tag->color }}">{{ $tag->label }}</span>
                            @empty
                                Nessun tag
                            @endforelse
                        </div>
                    </td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <a href=" {{ route('admin.posts.show', $post) }}" class="btn btn-primary text-white">
                            <i class="fa-solid fa-eye"></i><span class="mx-2">Mostra</span></a>

                    </td>
                    <td>
                        <a href=" {{ route('admin.posts.edit', $post) }}" class="btn btn-warning text-black">
                            <i class="fa-solid fa-pencil"></i><span class="mx-2">Modifica</span></a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mx-2" type="submit">
                                <i class="fa-solid fa-trash mx-2"></i>Elimina
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="colspan-6">
                        <h3 class="text-center">Nessun post</h3>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <section class="my-5" id="category-posts">
        <h2 class="mb-4">Post by Categories</h2>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-3 card">


                    <h3 class="my-3">{{ $category->label }} ({{ count($category->posts) }})</h3>
                    @forelse($category->posts as $post)
                        <p class="mb-4"><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></p>

                    @empty
                        <span class="my-2">Nessun post</span>
                    @endforelse
                </div>
            @endforeach
        </div>
    </section>
@endsection
