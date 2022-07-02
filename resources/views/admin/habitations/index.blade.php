@extends('layouts.app')

@section('content')

@foreach ($habitations as $habitation)
<p>

    {{$habitation->title}}
    {{-- @php
        var_dump($habitation['title']);
    @endphp --}}
</p>
@endforeach
    
@endsection