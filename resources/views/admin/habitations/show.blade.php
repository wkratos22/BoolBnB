@extends('layouts.app')

@section('content')

@include('includes.messages.success')

<div class="d-flex flex-column containerDue" style="min-height: 50vh">

    <h2 class="mt-24 mb-24">{{$habitation->title}}</h2>

    {{-- Table --}}
    <table class="table scroller">
        <thead>
          <tr class="gray-14">
            <th scope="col" class="">ANNUNCIO</th>
            <th scope="col" class="">STATO</th>
            <th scope="col" class="d-none d-sm-table-cell d-md-table-cell">PRENOTAZIONE IMMEDIATA</th>
            <th scope="col" class="d-none d-sm-table-cell d-md-table-cell">CAMERE DA LETTO</th>
            <th scope="col" class="d-sm-table-cell d-md-table-cell">BAGNI</th>
            <th scope="col" class="d-none d-sm-table-cell">POSIZIONE</th>
            <th scope="col" class="d-sm-table-cell d-md-table-cell">ULTIMA MODIFICA</th>
            <th scope="col" class=" d-flex justify-content-center">
                {{-- IMPOSTAZIONI --}}
                <img width="25px" haight="25px" src="{{asset('img/icons/icons8-gear-64.png')}}" alt="settings">
            </th>
          </tr>
        </thead>
        <tbody>
            <tr scope="row" class="bg-green-2">
                <td>
                    <img src="{{asset('img/icons/types/'. $habitation->habitationType->icon)}}" height="30px" width="30px" alt="">
                </td>

                @if ($habitation->visible == '0')
                    <td>Pubblico</td>
                @endif
                @if ($habitation->visible == '1')
                    <td>Nascosto</td>
                @endif

                <td class="d-flex align-items-center d-sm-table-cell d-md-table-cell">
                    <img width="25px" haight="25px" src="{{asset('img/icons/icons8-check-64.png')}}" alt="check-logo">
                    <span class="ml-8">On</span>
                </td>
                <td class="d-sm-table-cell d-md-table-cell">
                    <img class="align-middle" src="/img/icons/pageShow/room.png" alt="room icon">
                    <span class="ml-8 align-middle">{{$habitation->rooms_number}}</span>
                </td>
                <td class="d-sm-table-cell d-md-table-cell">
                    <img class="align-middle" src="/img/icons/pageShow/bathroom.png" alt="bathroom icon">
                    <span class="ml-8 align-middle">{{$habitation->bathrooms_number}}</span>
                </td>
                <td class="d-sm-table-cell d-md-table-cell">
                    <span class="ml-8 align-middle">{{$habitation->address}}</span>
                </td>
                <td class="d-sm-table-cell d-md-table-cell">
                    <span class="ml-8 align-middle">{{$habitation->updated_at}}</span>
                </td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                        IMPOSTAZIONI
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-green-5 text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Impostazioni</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                </div>
                                <div class="modal-footer d-flex flex-column align-items-start">
                                    <a href="{{ route('admin.sponsor', $habitation)}}" class="shadow-none">
                                        Sponsorizza
                                    </a>
                                    <a href="{{ route('admin.habitations.edit', $habitation->id)}}" class="shadow-none">
                                        Modifica annuncio
                                    </a>
                                    <form action="{{route('admin.habitations.destroy', $habitation->id)}}" method="post"
                                        class="deleteForm text-center mx-2" data-name="{{$habitation->title}}">

                                        @method('DELETE')

                                        @csrf

                                        <button type="submit" class="btn btn-light shadow-none">
                                            Elimina annuncio
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
      </table>

    <div class="d-flex justify-content-between">
        <div class="">
            {{-- <h5 class="card-title text-center my-4">
                <img src="{{asset('img/icons/types/'. $habitation->habitationType->icon)}}" height="30px" width="30px" alt="">
                {{$habitation->habitationType->label}}
            </h5> --}}

            <h2 class="mt-24 mb-24">Descrizione</h2>
            <p class="card-text">{{$habitation->description}}</p>

            <div class="my-5">
                <h2 class="mt-24 mb-24">Caratteristiche ambiente</h2>
                <div class="d-flex flex-wrap align-items-center">
                    @forelse ($habitation->tags as $tag)
                            <div class="d-flex justify-content-center align-items-center mr-32">
                                <img src="{{asset('img/icons/tags/'. $tag->icon)}}" height="24px" width="24px" class="mr-2"  alt="">
                                <span>{{$tag->label}}</span>
                            </div>
                    @empty
                        Nessuna informazione riguardo l'ambiente in cui si trova la struttura.
                    @endforelse
                </div>
            </div>

            <div class="my-5">
                <h2 class="mt-24 mb-24">Servizi disponibili</h2>
                <div class="d-flex flex-wrap align-items-center">
                    @forelse ($habitation->services as $service)
                        <div class="d-flex align-items-center mr-32">
                            <img src="{{asset('img/icons/services/'. $service->icon)}}" class="mr-2"  alt="">
                            <span>{{$service->label}}</span>
                        </div>
                    @empty
                        Nessuna informazione riguardo l'ambiente in cui si trova la struttura.
                    @endforelse
                </div>
            </div>
        </div>

        <div>
            <h2 class="mt-24 mb-24">Immagini</h2>
            @if ($habitation->images->count() > 0)
                <div id="showCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    @foreach ($habitation->images as $key => $image)
                        <div class="carousel-item border rounded {{$key == 0 ? 'active' : ''}}">
                            <img src="{{asset( "storage/$image->image_url" )}}" class="d-block w-100" height="500px" widht="1000px" alt="...">
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

                <div >
                    <img src="https://source.unsplash.com/random/?home" height="240px" width="240px" alt="...">
                </div>

            @endif
        </div>

    </div>

</div>

<div class="mt-110 mb-110 containerDue">

    <h2 class="mt-24 mb-24">Posta</h2>

    @if ($habitation->messages->count())

         <div class="mt-4">
             <table class="table">
                 <thead class="thead-dark">
                     <tr>
                     <th scope="col">Nome mittente</th>
                     <th scope="col">Email mittente</th>
                     <th scope="col">Testo</th>
                     </tr>
                 </thead>
                 <tbody>

                     @foreach ($habitation->messages as $message)
                     <tr>
                         <td>{{$message->name}}</td>
                         <td>{{$message->email_sender}}</td>
                         <td>{{$message->text_message}}</td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>

    @else
         <h3 class="text-center mt-5 mb-5">Non hai ricevuto alcun messaggio per il tuo annuncio...</h3>
    @endif
 </div>


@endsection
