@extends('layouts.app')

@section('title')
    Crea Annuncio
@endsection

@section('content')
<div class="containerDue">
    @include('includes.validation.errors')
    
    <small class="form-text text-muted mb-3">Campo obbligatorio *</small>

    <form action="{{ route('admin.habitations.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title" class="pb-2">
                <h4>
                    Titolo dell'annuncio *
                </h4>
            </label>
            <input type="text" class="form-control bg-transparent c_border" id="title" placeholder="Inserisci il titolo"
                name="title" maxlength="100" value="{{old('title')}}" required>
        </div>

        <div class="form-group">
            <label for="habitation_type" class="pb-2">
                <h4>
                    Tipologia *
                </h4>
            </label>
            <select class="form-control bg-transparent c_border" id="habitation_type" name="habitation_type_id">
                @foreach ($type_hab as $type)

                <option value="{{$type->id}}">{{$type->label}}</option>

                @endforeach
            </select>
        </div>

        <div class="my-3">
            <h4 class="pb-2">
                Caratteristiche della struttura *
            </h4>
            <div class="form-check form-check-inline flex-wrap"  id="formCheck1">

                @foreach ($tags_hab as $tag)
                <div class="my-1 check-responsive">
                    <input class="form-check-input" type="checkbox" id="tag{{$tag->id}}" value="{{$tag->id}}"
                        name="tags[]" @if( in_array($tag->id, old('tags', []) ) ) checked @endif>

                    <label class="form-check-label " for="tag{{$tag->id}}">{{$tag->label}}</label>


                </div>

                @endforeach

            </div>
        </div>

        <div class="my-3">
            <h4 class="pb-2">
                Servizi presenti nella struttura *
            </h4>
            <div class="form-check form-check-inline flex-wrap" id="formCheck2">

                @foreach ($service_hab as $service)
                <div class="my-1 check-responsive">
                    <input class="form-check-input" type="checkbox" id="service{{$service->id}}"
                        value="{{$service->id}}" name="services[]" @if( in_array($service->id, old('services', []) ) )
                    checked @endif>

                    <label class="form-check-label me-3 " for="service{{$service->id}}">{{$service->label}}</label>
                </div>

                @endforeach

            </div>
        </div>


        <div class="form-group">
            <label for="description" class="pb-2">
                <h4>
                    Descrizione *
                </h4>
            </label>
            <textarea class="form-control bg-transparent c_border" id="description" rows="3" name="description"
                placeholder="Inserisci la descrizione" required>
                {{old('description')}}
            </textarea>
        </div>

        <div class="form-group">
            <label for="price" class="pb-2">
                <h4>
                    Prezzo per notte *
                </h4>
            </label>
            <input type="number" class="form-control bg-transparent c_border" id="price" name="price" min="1"
                max="25000" placeholder="200" value="{{old('price')}}" required>
        </div>

        <div class="form-group">
            <label for="address" class="pb-2">
                <h4>
                    Indirizzo *
                </h4>
            </label>
            <input type="text" class="form-control bg-transparent c_border" id="address" name="address"
                placeholder="Via Roma 25, Napoli, 80125, Campania, Italia" value="{{old('address')}}" required>
        </div>

        <div class="form-group">
            <label for="guests_number" class="pb-2">
                <h4>
                    Numero massimo di ospiti *
                </h4>
            </label>
            <input type="number" class="form-control bg-transparent c_border" id="guests_number" name="guests_number"
                min="1" placeholder="8" value="{{old('guests_number')}}" required>
        </div>

        <div class="form-group">
            <label for="rooms_number" class="pb-2">
                <h4>
                    Numero stanze *
                </h4>
            </label>
            <input type="number" class="form-control bg-transparent c_border c_green" id="rooms_number" name="rooms_number"
                min="1" placeholder="5" value="{{old('rooms_number')}}" required>
        </div>

        <div class="form-group">
            <label for="beds_number" class="pb-2">
                <h4>
                    Numero letti *
                </h4>
            </label>
            <input type="number" class="form-control bg-transparent c_border" id="beds_number" name="beds_number"
                min="1" placeholder="6" value="{{old('beds_number')}}" required>
        </div>

        <div class="form-group">
            <label for="bathrooms_number" class="pb-2">
                <h4>
                    Numero bagni *
                </h4>
            </label>
            <input type="number" class="form-control bg-transparent c_border" id="bathrooms_number"
                name="bathrooms_number" min="1" placeholder="2" value="{{old('bathrooms_number')}}" required>
        </div>

        <div class="form-group">
            <label for="square_meters" class="pb-2">
                <h4>
                    Metri quadrati *
                </h4>
            </label>
            <input type="number" class="form-control bg-transparent c_border" id="square_meters" name="square_meters"
                min="1" value="{{old('square_meters')}}" placeholder="85" required>
        </div>

        <div class="form-group d-inline-block">
            <label for="image" class="pb-2">
                <h4 class="my-2">
                    Images *
                </h4>
            </label>
            <input type="file" class="form-control-file " id="image" name="image[]" multiple required>
        </div>


        <div class="mt-3">
            <h4 class="pb-2">
                Visibilità dell'annuncio *
            </h4>

            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="visible" id="noVisible" value="0">
                    <label class="form-check-label" for="noVisible">
                        Nascosto
                    </label>
                </div>

                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="visible" id="visible" value="1" checked>
                    <label class="form-check-label" for="visible">
                        Visibile
                    </label>
                </div>

            </div>
        </div>


        <div class="text-center py-5">
            <button class="btn color_button w-25 b-rounded-3 p-2 shadow-none" style="margin: 10px auto;" type="submit"
                src="{{route('admin.habitations.store')}}">
                Crea
            </button>
        </div>


    </form>
</div>






@endsection
