@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </div>
@endif

@if ($post->exists)
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST" novalidate>
@endif

@csrf
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{ old('title', $post->title) }}" required minlenght="5" maxlenght="50">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">Nessuna categoria</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->label }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }} </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" rows="6" name="content" required>{{ old('content', $post->content) }}</textarea>
        </div>
    </div>
    @if (count($tags))
        <div class="col-12 mb-2">
            <fieldset>
                <h5>Tags</h5>
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="tag-{{ $tag->label }}" name="tags[]"
                            value="{{ $tag->id }}" @if (in_array($tag->id, old('tags', $prev_tags ?? []))) checked @endif>
                        <label class="form-check-label" for="tag-{{ $tag->label }}"> {{ $tag->label }}</label>
                    </div>
                @endforeach
            </fieldset>
        </div>
    @endif
    <div class="col-11">
        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="url" class="form-control" id="image" name="image"
                value="{{ old('image', $post->image) }}">
        </div>
    </div>
    <div class="col-1 mt-4">
        <img src="{{ $post->image ?? 'https://i1.wp.com/potafiori.com/wp-content/uploads/2020/04/placeholder.png?ssl=1' }}"
            alt="post image preview" id="preview" class="img-fluid">
    </div>
</div>
<hr />


<footer class="d-flex justify-content-between">
    <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">
        <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
    </a>
    <button class="btn btn-success" type="submit">
        <i class="fa-solid fa-floppy-disk mr-2"></i> Salva
    </button>
</footer>


</form>
