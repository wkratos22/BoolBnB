@extends('layouts.app')

@section('content')

    <div class="bg-lightBlue">
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

    @include('includes.messages.success')

    </div>

   <div class="d-flex flex-wrap justify-content-center my-1 mx-auto">
    
       @foreach ($habitations as $habitation)

       <div class="card w-50 m-4">
        @if ($habitation->images->count() == 0)
            <a href="{{route('admin.habitations.show', $habitation->id)}}">
                <img src="https://source.unsplash.com/random/?home" class="card-img-top" height="185px" alt="...">
            </a>
        @else


        @foreach ($habitation->images as $image)

            @if ($loop->first)
                <a href="{{route('admin.habitations.show', $habitation->id)}}">
                    <img src="{{asset( "storage/$image->image_url" )}}" class="card-img-top" height="185px" alt="...">
                </a>
            @endif

            @endforeach
        @endif
           
           <div class="card-body">
             <h5 class="card-title">{{$habitation->title}}</h5>
             <p class="card-text">{{$habitation->price}} € </p>
             
           </div>
       </div>
       @endforeach
   </div>

@endsection
