@if (session('message'))
    <div class="alert alert-success text-center my-3">
        {{ session('message') }}
    </div>
@endif 