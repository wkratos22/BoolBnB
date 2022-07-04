{{-- pop up di conferma eliminazione --}}
@if (session('message'))
    <div class="alert alert-success my-3">
        {{ session('message') }}
    </div>
@endif