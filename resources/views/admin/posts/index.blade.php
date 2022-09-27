@extends('layouts.app')

@section('content')

<div class="container">


<table class="table table-striped table-dark border-1">
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
        </tr>
        @empty
        <tr>
            <td class="colspan-6">
                <h3 class="text*center">Nessun post</h3>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

</div>


@endsection
