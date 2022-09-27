@if (session('message'))
    <div class="alert alert-{{ session('type') ?? 'info' }}">
        {{ session('message') }}
    </div>
@endif