@extends('layouts.app')

@section('content')

@include('includes.messages.success')

<div class="d-flex" style="min-height: 50vh">

    @if ($habitation->images->count() > 0)
        <div id="showCarousel" class="carousel slide w-50" data-ride="carousel">
            <div class="carousel-inner">
            @foreach ($habitation->images as $key => $image)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <img src="{{asset( "storage/$image->image_url" )}}" class="d-block w-100" height="500px" alt="...">
                </div>
            @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-target="#showCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon" style="filter: invert(1);" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#showCarousel" data-slide="next">
                <span class="carousel-control-next-icon" style="filter: invert(1);" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>

        </div>

        @else

        <div class="h-100 w-50">
            <img src="https://source.unsplash.com/random/?home" class="w-100 h-100" alt="...">
        </div>
    

        
        
    @endif

        <div class="card w-50 h-100">
            <h5 class="card-header">{{$habitation->title}}</h5>
            <div class="card-body">
            <h5 class="card-title text-center my-4">
                <img src="{{asset('img/icons/types/'. $habitation->habitationType->icon)}}" height="30px" width="30px" alt="">
                {{$habitation->habitationType->label}}
            </h5>

            <p class="card-text">{{$habitation->description}}</p>

            <div class="my-5">
                <h6 class="text-center mb-4">
                    <strong>

                        Caratteristiche dell'ambiente:
                    </strong>
                </h6>
                <div class="d-flex flex-wrap justify-content-around align-items-center">
                   @forelse ($habitation->tags as $tag)
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{asset('img/icons/tags/'. $tag->icon)}}" height="24px" width="24px" class="mr-2"  alt="">
                            <span>{{$tag->label}}</span>
                        </div>
                   @empty
                    Nessuna informazione riguardo l'ambiente in cui si trova la struttura.
                   @endforelse
                </div>
            </div>

            <div class="my-5">
                <h6 class="text-center mb-4">
                    <strong>

                        Servizi disponibili:
                    </strong>
                </h6>
                <div class="d-flex flex-wrap justify-content-around align-items-center">
                    @forelse ($habitation->services as $service)
                         <div class="d-flex justify-content-center align-items-center">
                             <img src="{{asset('img/icons/services/'. $service->icon)}}" height="24px" width="24px" class="mr-2"  alt="">
                             <span>{{$service->label}}</span>
                         </div>
                    @empty
                     Nessuna informazione riguardo l'ambiente in cui si trova la struttura.
                    @endforelse
                 </div>
            </div>

            
            <div class="d-flex justify-content-around align-items-center">
                <a href="{{ route('admin.habitations.edit', $habitation->id)}}" class="btn btn-success shadow-none">
                    Modifica annuncio
                </a>


                <form action="{{route('admin.habitations.destroy', $habitation->id)}}" method="post"
                    class="deleteForm text-center mx-2" data-name="{{$habitation->title}}">

                    @method('DELETE')

                    @csrf

                    <button type="submit" class="btn btn-danger shadow-none">
                        Elimina annuncio
                    </button>

                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
