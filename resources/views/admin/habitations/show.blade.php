@extends('layouts.app')

@section('title')
    {{$habitation->title}}
@endsection

@section('content')

@include('includes.messages.success')

<div class="d-flex flex-column containerDue">

    <h2 class="mt-24 mb-24">{{$habitation->title}}</h2>

    {{-- Table --}}
    <table>
        <thead class="bg-green">
          <tr class="text-dark align-middle">
            <th scope="col" class="align-middle p-16">ANNUNCIO</th>
            <th scope="col" class="align-middle p-16">STATO</th>
            <th scope="col" class="align-middle p-16 display-none-2">CAMERE DA LETTO</th>
            <th scope="col" class="align-middle p-16 display-none">BAGNI</th>
            <th scope="col" class="align-middle display-none display-none-3">POSIZIONE</th>
            <th scope="col" class="align-middle p-16 display-none">ULTIMA MODIFICA</th>
            <th scope="col" class="align-middle p-16 d-flex justify-content-center b-right-radius">
                {{-- IMPOSTAZIONI --}}
                <button type="button" class="btn btn-light btn-media-query" data-toggle="modal" data-target="#exampleModal">
                    IMPOSTAZIONI
                </button>
            </th>
          </tr>
        </thead>
        <tbody>
            <tr scope="row">
                <td class="p-16">
                    <img src="{{asset('img/icons/types/'. $habitation->habitationType->icon)}}" height="30px" width="30px" alt="">
                </td>

                @if ($habitation->visible == '1')
                    <td>Pubblico</td>
                @endif
                @if ($habitation->visible == '0')
                    <td>Nascosto</td>
                @endif

                <td class="display-none-2 p-16">
                    <img class="align-middle" src="/img/icons/pageShow/room.png" alt="room icon">
                    <span class="ml-8 align-middle">{{$habitation->rooms_number}}</span>
                </td>
                <td class="display-none p-16">
                    <img class="align-middle" src="/img/icons/pageShow/bathroom.png" alt="bathroom icon">
                    <span class="ml-8 align-middle">{{$habitation->bathrooms_number}}</span>
                </td>
                <td class="display-none display-none-3 p-16">
                    <span class="align-middle">{{$habitation->address}}</span>
                </td>
                <td class="display-none p-16">
                    <span class="align-middle">{{$habitation->updated_at}}</span>
                </td>

                <td>

                    <!-- Modal -->
                    <div class="modal modal-custom fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-custom" role="document">
                            <div class="modal-content-custom">
                                <div class="modal-header text-white bg-green">
                                    {{-- <h5 class="modal-title" id="exampleModalLabel">Impostazioni</h5> --}}
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    {{-- <div class="modal-body">
                                </div> --}}
                                <div class="modal-footer d-flex flex-column align-items-start pt-0">
                                    <a href="{{ route('admin.sponsor', $habitation)}}" class="gray-20-hover btn shadow-none">
                                        Sponsorizza
                                    </a>
                                    <div class="b-2 mb-8 mt-8"></div>
                                        <a href="{{ route('admin.habitations.edit', $habitation->id)}}" class="gray-20-hover btn shadow-none">
                                            Modifica annuncio
                                        </a>
                                    <div class="b-2 mb-8 mt-8"></div>
                                    <form action="{{route('admin.habitations.destroy', $habitation->id)}}" method="post"
                                          class="deleteForm text-center mx-2" data-name="{{$habitation->title}}">
                                          @method('DELETE')
                                          @csrf

                                        <button type="submit" class="btn gray-20-hover shadow-none">
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

    <div class="d-flex media-query-self-start justify-content-between flex-direction">
        <div class="margin-media-query-description media-query-self-start width-media-query">
            <h2 class="mt-24 mb-24 width-media-query media-query-self-start">Descrizione</h2>
            <p class="card-text width-media-query media-query-self-start">{{$habitation->description}}</p>

            <div class="mt-32 width-media-query media-query-self-start">
                <h2 class="mt-24 mb-24 width-media-query media-query-self-start">Caratteristiche ambiente</h2>
                <div class="d-flex width-media-query flex-wrap align-items-center media-query-self-start">
                    @forelse ($habitation->tags as $tag)
                            <div class="d-flex justify-content-center align-items-center mr-32 mb-32">
                                <img src="{{asset('img/icons/tags/'. $tag->icon)}}" height="24px" width="24px" class="mr-2"  alt="">
                                <span>{{$tag->label}}</span>
                            </div>
                    @empty
                        Nessuna informazione riguardo l'ambiente in cui si trova la struttura.
                    @endforelse
                </div>
            </div>

            <div class="my-5 width-media-query media-query-self-start">
                <h2 class="mt-24 mb-24 width-media-query media-query-self-start">Servizi disponibili</h2>
                <div class="d-flex flex-column width-media-query flex-wrap media-query-self-start">
                    @forelse ($habitation->services as $service)
                        <div class="d-flex align-items-center mr-32 mb-32 media-query-self-start">
                            <img src="{{asset('img/icons/services/'. $service->icon)}}" class="mr-2 media-query-self-start"  alt="">
                            <span class="media-query-self-start">{{$service->label}}</span>
                        </div>
                    @empty
                        Nessuna informazione riguardo l'ambiente in cui si trova la struttura.
                    @endforelse
                </div>
            </div>
        </div>

        <div class="img-carousel-w-h">
            <h2 class="mt-24 mb-24 media-query-text-left">Immagini</h2>
            @if ($habitation->images->count() > 0)
                <div id="showCarousel" class="carousel slide img-carousel-w-h" data-ride="carousel">
                    <div class="carousel-inner">
                    @foreach ($habitation->images as $key => $image)
                        <div class="carousel-item border rounded img-carousel-w-h {{$key == 0 ? 'active' : ''}}">
                            <img src="{{asset( "storage/$image->image_url" )}}" class="d-block img-carousel-w-h" alt="...">
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

<div class="containerDue margin-media-query-mail">

    
    @if ($habitation->messages->count())
        <h2 class="mt-24 mb-24 text-center">Posta</h2>

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

@section('scripts')
    <script src="{{asset('js/deleteConfirm.js')}}"></script>
@endsection
