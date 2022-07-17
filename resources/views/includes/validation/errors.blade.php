@if ($errors->any())

{{-- <div class="alert alert-danger mt-3">
    <ul style="list-style-type: initial">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div> --}}
<div class="alert alert-danger alert-dismissible fade show w-75 mx-auto mt-3 pr-0 pr-md-3">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            <hr>
        @endforeach
    </ul>
    <button class="close p-0" data-dismiss="alert"  style="top: -1px; right: 5px;">&times;</button>
  </div>

@endif