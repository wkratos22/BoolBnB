@extends('layouts.app')

@include('includes.validation.errors')

@section('content')

    <small class="form-text text-muted mb-3">* Campo obbligatorio</small>

    <form action="{{ route('admin.habitations.update', $habitation->id)}}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf

        <div class="form-group">
            <label for="title">
            <h4>
                * Titolo dell'annuncio:
            </h4>
            </label>
            <input type="text" class="form-control" id="title" placeholder="Inserisci il titolo" name="title" maxlength="100" value="{{old('title', $habitation->title)}}" required>
        </div>

        <div class="form-group">
            <label for="habitation_type">
                <h4>
                    * Tipologia:
                </h4>
            </label>
            <select class="form-control" id="habitation_type" name="habitation_type_id">
                @foreach ($type_hab as $type)

                <option  value="{{$type->id}}" @if (old('habitation_type_id', $habitation->habitation_type_id) == $type->id) selected

                         @endif>
                         {{$type->label}}
                </option>

                @endforeach
            </select>
        </div>

        <div class="my-3">
            <h4>
                * Caratteristiche della struttura:
            </h4>
            <div class="form-check form-check-inline flex-wrap">

                @foreach ($tags_hab as $tag)
                    <div class="my-1" style="width: 15%">
                        <input class="form-check-input" type="checkbox" id="tag{{$tag->id}}" value="{{$tag->id}}" name="tags[]" @if( in_array($tag->id, old('tags', $habitation_tags_id) ) ) checked @endif>
                        <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->label}}</label>
                    </div>

                @endforeach

            </div>
        </div>

        <div class="my-3">
            <h4>
                * Servizi presenti nella struttura:
            </h4>
            <div class="form-check form-check-inline flex-wrap">

                @foreach ($service_hab as $service)
                    <div class="my-1" style="width: 15%">
                        <input class="form-check-input" type="checkbox" id="service{{$service->id}}" value="{{$service->id}}" name="services[]" @if( in_array($service->id, old('services', $habitation_services_id) ) ) checked @endif>
                        <label class="form-check-label" for="service{{$service->id}}">{{$service->label}}</label>
                    </div>

                @endforeach

            </div>
        </div>


        <div class="form-group">
            <label for="description">
                <h4>
                    * Descrizione:
                </h4>
            </label>
            <textarea class="form-control" id="description" rows="3" name="description" placeholder="Inserisci la descrizione" required>
                {{old('description', $habitation->description)}}
            </textarea>
        </div>

        <div class="form-group">
            <label for="price">
                <h4>
                    * Prezzo per notte:
                </h4>
            </label>
            <input type="number" class="form-control" id="price" name="price" min="1" max="25000" placeholder="200" value="{{old('price', $habitation->price)}}" required>
        </div>

        <div class="form-group">
            <label for="address">
                <h4>
                    * Indirizzo:
                </h4>
            </label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Via Roma 25, Napoli, 80125, Campania, Italia" value="{{old('address', $habitation->address)}}" required>
        </div>

        <div class="form-group">
            <label for="guests_number">
                <h4>
                    * Numero massimo di ospiti:
                </h4>
            </label>
            <input type="number" class="form-control" id="guests_number" name="guests_number" min="1" placeholder="8" value="{{old('guests_number', $habitation->guests_number)}}" required>
        </div>

        <div class="form-group">
            <label for="rooms_number">
                <h4>
                    * Numero stanze:
                </h4>
            </label>
            <input type="number" class="form-control" id="rooms_number" name="rooms_number" min="1" placeholder="5" value="{{old('rooms_number', $habitation->rooms_number)}}" required>
        </div>

        <div class="form-group">
            <label for="beds_number">
                <h4>
                    * Numero letti:
                </h4>
            </label>
            <input type="number" class="form-control" id="beds_number" name="beds_number" min="1" placeholder="6" value="{{old('beds_number', $habitation->beds_number)}}" required>
        </div>

        <div class="form-group">
            <label for="bathrooms_number">
                <h4>
                    * Numero bagni:
                </h4>
            </label>
            <input type="number" class="form-control" id="bathrooms_number" name="bathrooms_number" min="1" placeholder="2" value="{{old('bathrooms_number', $habitation->bathrooms_number)}}" required>
        </div>

        <div class="form-group">
            <label for="square_meters">
                <h4>
                    Metri quadrati:
                </h4>
            </label>
            <input type="number" class="form-control" id="square_meters" name="square_meters" min="1" value="{{old('square_meters', $habitation->square_meters)}}" placeholder="85">
        </div>

        <div class="form-group">
            <label for="image">
                <h4>
                    * Images:
                </h4>
            </label>
            <input type="file" class="form-control-file" id="image" name="image[]" value="" multiple>
        </div>


        <div>
            <h4>
                * Visibilità dell'annuncio:
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



        <button class="btn btn-success w-25 b-rounded-3" style="margin: 10px auto;" type="submit" src="{{route('admin.habitations.update', $habitation->id)}}">
            Edit
        </button>

        </form>





@endsection