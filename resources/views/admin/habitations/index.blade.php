@extends('layouts.app')

@section('content')

    <h4 class="mb-4 text-center">
    @if ($habitations->count() > 0)
        
        Ciao {{Auth::user()->name}}, hai pubblicato {{$habitations->count()}} annunci!
        @else
        Ciao {{Auth::user()->name}}, clicca qui sotto per pubblicare il tuo primo annuncio!
        
    @endif
    </h4>

    <div class="text-center">
        <a class="btn btn-success" href="{{ route('admin.habitations.create')}}">Crea Annuncio</a>
    </div>


   <div class="d-flex flex-wrap justify-content-center my-5 mx-auto">

       @foreach ($habitations as $habitation)
    
       <div class="card w-25 m-3">
    
           {{-- <img src="{{asset('storage/habitations_images/')}}" class="card-img-top" alt="..."> --}}
           <div class="card-body">
             <h5 class="card-title">{{$habitation->title}}</h5>
             <p class="card-text">{{$habitation->price}} € </p>
             <div  class="text-center">
                <a class="btn btn-primary" href="{{route('admin.habitations.show', $habitation->id)}}">View</a>
             </div>
           </div>
       </div>
       @endforeach

   </div>


@endsection
