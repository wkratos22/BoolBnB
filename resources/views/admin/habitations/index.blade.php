@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="create-gradient d-flex justify-content-between align-items-center py-2 px-5">
        <h4 class="text-white welcomeUser">
            Ciao <span class="firstLetterUpp">{{Auth::user()->name}}</span>, benvenuto nella tua area personale!
        </h4>

        <a href="{{ route('admin.habitations.create')}}" class="btn btn_outline_green shadow-none desktopCreate">Crea Annuncio</a>
    </div>

    <div class="container-fluid">
    
        <div class="wrapperPseudoStats row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-4">
            <div class="col p-2 p-md-4 text-center">
                <p class="pseudoStats">{{$habitations->count()}}</p>
                <h3 class="mb-3">Annunci</h3>
            </div>
    
            <div class="col p-4 text-center">
                <p class="pseudoStats">{{$visibleHabs->count()}}</p>
                <h3 class="mb-3">Visibili</h3>
            </div>
            
            <div class="col p-4 text-center">
                <p class="pseudoStats">{{$habitations->count() - $visibleHabs->count()}}</p>
                <h3 class="mb-3">Nascosti</h3>
            </div>
            
            <div class="col p-4 text-center">
                <p class="pseudoStats">{{$sponsoredHabs->count()}}</p>
                <h3 class="mb-3">Sponsorizzati</h3>
            </div>
        </div>
    </div>

    @include('includes.messages.success')

    <div class="container py-4">

        @if ($habitations->count() > 0)    
            <div class="text-center mobileCreate mb-5">
                <a href="{{ route('admin.habitations.create')}}" class="btn btn_outline_green">Crea Annuncio</a>
            </div>
        @endif

        <div>
           @if ($habitations->count() > 0)
            
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Titolo</th>
                        <th scope="col" class="d-none d-sm-table-cell">Stato</th>
                        <th scope="col" class="habPrice">Prezzo</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($habitations as $habitation)
                            <tr>
                                <th scope="row">{{$habitation->id}}</th>

                                <td>
                                    @foreach ($habitation->images as $image)
                                        @if ($loop->first)
                                            <img src="{{asset( "storage/$image->image_url" )}}" height="50px" width="65px" alt="...">
                                        @endif
                                    @endforeach
                                </td>

                                <td>{{$habitation->title}}</td>

                                <td class="d-none d-sm-table-cell">
                                    @if ($habitation->visible)
                                        Visibile
                                    @else
                                        Nascosto
                                    @endif
                                </td>

                                <td class="habPrice">{{$habitation->price}} € /notte</td>

                                <td class="text-center">
                                    <a class="btn btn_green shadow-none" href="{{route('admin.habitations.show', $habitation->id)}}">Vedi</a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

                {{-- @if( $habitations->hasPages() )
                    {{ $habitations->links() }}
                @endif --}}

            @else

                <div class="d-flex flex-column flex-md-row justify-content-around align-items-center">
                    <div>
                        <img src="/images/BoolBnb_15.png" alt="home img" width="300px" style="margin: -50px 0">
                    </div>
                    <div class="text-center text-md-left">
                        <h3>
                            Mai stato così semplice. Ti basta un click per iniziare gratuitamente il tuo business da CASA!
                        </h3>
                    </div>

                    @if ($habitations->count() == 0)    
                        <div class="text-center mobileCreate mt-5">
                            <a href="{{ route('admin.habitations.create')}}" class="btn btn_outline_green">Crea Annuncio</a>
                        </div>
                    @endif
                </div>
            
            @endif
        </div>

    </div>

@endsection

{{-- <div class="hab-card card-cust">
    <div class="wrapper">
        @foreach ($habitation->images as $image)

        @if ($loop->first)
            <a href="{{route('admin.habitations.show', $habitation->id)}}">
                <img src="{{asset( "storage/$image->image_url" )}}" height="350px" width="100%" alt="...">
            </a>
        @endif

        @endforeach
        <div class="hab-visibility {{$habitation->visible == false ? 'p-2' : ''}}">
            @if ($habitation->visible == false)
                <span class="day">
                    Hidden
                </span>
            @endif
        </div>
        <div class="data">
            <div class="content">
                <h2 class="title">{{$habitation->title}}</h2>
                <p class="text">{{$habitation->price}} € /notte</p>
            </div>
        </div>
    </div>
</div> --}}