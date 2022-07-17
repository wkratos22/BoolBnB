@if (session('message'))
    {{-- <div class="alert alert-success text-center my-3" style="width: 85%; margin: 0 auto;">
        {{ session('message') }}
    </div> --}}
    <div class="alert alert-success alert-dismissible fade show w-75 mx-auto text-center my-3">
        {!! session('message') !!}
        <button class="close p-0" data-dismiss="alert"  style="top: -1px; right: 5px;">&times;</button>
      </div>
@endif 