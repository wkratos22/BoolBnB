@extends('layouts.app')

@section('content')

    <div class="bg-lightBlue">
    <h4 class="text-left d-inline-block p-3 font">
    @if ($habitations->count() > 0)
        
        Ciao {{Auth::user()->name}}, hai pubblicato {{$habitations->count()}} annunci!
        @else
        Ciao {{Auth::user()->name}}, clicca qui sotto per pubblicare il tuo primo annuncio!
        
    @endif
    </h4>

    

    <div class="ml-3 pb-3">
        <a class="btn btn-success" href="{{ route('admin.habitations.create')}}">Crea un nuovo annuncio</a>
    </div>

    </div>

   <div class="d-flex flex-wrap justify-content-center my-1 mx-auto">
    
       @foreach ($habitations as $habitation)
       <div class="card w-50 m-4">
    
           {{-- <img src="{{asset('storage/habitations_images/')}}" class="card-img-top" alt="..."> --}}
           <div class="card-body">
             <h5 class="card-title">{{$habitation->title}}</h5>
             <p class="card-text">{{$habitation->price}} € </p>
             <div  class="text-center">
                <a class="btn btn-primary" href="{{route('admin.habitations.show', $habitation->id)}}">Visualizza</a>
             </div>
           </div>
       </div>
       @endforeach
   </div>

@endsection
