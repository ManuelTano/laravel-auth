@extends('layouts.app')

@section('content')
<a href=" {{ route('admin.posts.create') }}" class="btn btn-success text-white">
    <i class="fa-solid fa-plus "><span class="mx-2">Nuovo</span></i></a>
    <table class="table table-striped table-dark border-1 mt-4">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
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
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->update_at }}</td>
                    <td>
                        <a href=" {{ route('admin.posts.show', $post) }}" class="btn btn-primary text-white">
                            <i class="fa-solid fa-eye"></i><span class="mx-2">Mostra</span></a>
                            
                    </td>
                    <td>
                        <a href=" {{ route('admin.posts.edit', $post) }}" class="btn btn-warning text-black">
                            <i class="fa-solid fa-pencil"><span class="mx-2">Modifica</span></i></a>
                            
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
@endsection
