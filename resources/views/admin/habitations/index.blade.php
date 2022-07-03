@extends('layouts.app')

@section('content')

    <a class="btn btn-success" href="{{ route('admin.habitations.create')}}">Annuncio</a>

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
