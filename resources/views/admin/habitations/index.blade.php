@extends('layouts.app')

@section('content')

@foreach ($habitations as $habitation)
<p>

    {{$habitation->title}}
    {{-- @php
        var_dump($habitation['title']);
    @endphp --}}
    <a class="btn btn-primary" href="{{route('admin.habitations.show', $habitation->id)}}">View</a>
</p>
@endforeach

@endsection
