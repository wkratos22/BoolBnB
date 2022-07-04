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

@include('includes.messages.success')

   <div class="d-flex flex-wrap justify-content-center my-5 mx-auto">

       @foreach ($habitations as $habitation)
    
       <div class="card w-25 m-3">

        <div id="carouselExampleControls" class="carousel slide w-100" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
            @foreach ($habitation->images as $key => $image)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <img src="{{asset( "storage/$image->image_url" )}}" class="d-block w-100" alt="...">
                </div>
            @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                <span class="carousel-control-prev-icon" style="filter: invert(1);" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" style="filter: invert(1);" type="button" data-target="#carouselExampleControls" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    
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
