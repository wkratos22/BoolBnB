@extends('layouts.app')



@section('content')

    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <h2>Dashboard</h2>
            </div>
        </div>

        <div class="row mb-24">
        {{-- <div class="col-12 col-md-6 ">
            <div class="slider-container">
                SLIDER
            </div>
        </div> --}}

        <div class="col-6 col-md-6">
            <div class="rest-title">
                <div class="div">
                    <small>Benvenuto <span> {{Auth::user()->name}}</span></small>
                </div>
            </div>

            <h4 class="mb-4 text-center">
                @if ($habitations->count() > 0)

                    Ciao {{Auth::user()->name}}, hai pubblicato {{$habitations->count()}} annunci!
                    @else
                    Ciao {{Auth::user()->name}}, clicca qui sotto per pubblicare il tuo primo annuncio!

                @endif
            </h4>

            @include('includes.messages.success')

            <div class="rest-title">
                <h4>Annunci</h4>
            </div>

        </div>



        <div class="grid-container">

            @foreach ($habitations as $habitation)

                <div class="mycard-container">
                    <div class="mycard">
                        @if ($habitation->images->count() == 0)
                            <a class="image d-flex align-items-center justify-content-center" href="{{route('admin.habitations.show', $habitation->id)}}">
                                <img src="https://source.unsplash.com/random/?home" class="h-80" height="185px" alt="...">
                            </a>
                            @else


                            @foreach ($habitation->images as $image)

                                @if ($loop->first)
                                    <a href="{{route('admin.habitations.show', $habitation->id)}}">
                                        <img src="{{asset( "storage/$image->image_url" )}}" class="h-80" height="185px" alt="...">
                                    </a>
                                @endif

                            @endforeach
                        @endif
                    </div>


                    <div class="content">
                        <h5 class="card-title">{{$habitation->title}}</h5>
                        <p class="card-text">{{$habitation->price}} € </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection


