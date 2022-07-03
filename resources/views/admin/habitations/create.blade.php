@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="{{ route('admin.habitations.store')}}" method="POST" enctype="multipart/form-data">
              @csrf

            <div class="form-group">
              <label for="title">* Title:</label>
              <input type="text" class="form-control" id="title" placeholder="Inserisci il titolo" name="title" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="habitation_type">Example select</label>
                <select class="form-control" id="habitation_type" name="habitation_type_id">
                   @foreach ($type_hab as $type)
                    
                    <option value="{{$type->id}}">{{$type->label}}</option>

                   @endforeach
                </select>
            </div>

            <div class="form-check form-check-inline">
                    
                @foreach ($tags_hab as $tag)

                    <input class="form-check-input" type="checkbox" id="tag{{$tag->id}}" value="{{$tag->id}}">
                    <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->label}}</label>

                @endforeach

            </div>

            <div class="form-check form-check-inline">
                    
                @foreach ($service_hab as $service)

                    <input class="form-check-input" type="checkbox" id="service{{$service->id}}" value="{{$service->id}}">
                    <label class="form-check-label" for="service{{$service->id}}">{{$service->label}}</label>

                @endforeach

            </div>

            <div class="form-group">
                <label for="description">* Description:</label>
                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Inserisci la descrizione" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">* Price:</label>
                <input type="number" class="form-control" id="price" name="price" min="1" max="99999" step="0.01" placeholder="Inserisci il prezzo" required>
            </div>

            <div class="form-group">
                <label for="address">* Address:</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Inserisci l'indirizzo" required>
            </div>

            <div class="form-group">
                <label for="latitude">* Latitude:</label>
                <input type="number" class="form-control" id="latitude" name="latitude" min="-90" max="90" step="0.00001" placeholder="Inserisci la latitudine" required>
            </div>

            <div class="form-group">
                <label for="longitude">* Longitude:</label>
                <input type="number" class="form-control" id="longitude" name="longitude" min="-180" max="180" step="0.00001" placeholder="Inserisci la longitudine" required>
            </div>

            <div class="form-group">
                <label for="guests_number">* Guests number:</label>
                <input type="number" class="form-control" id="guests_number" name="guests_number" min="1" placeholder="Inserisci il numero massimo di ospiti" required>
            </div>

            <div class="form-group">
                <label for="rooms_number">* Rooms number:</label>
                <input type="number" class="form-control" id="rooms_number" name="rooms_number" min="1" placeholder="Inserisci il numero di stanze" required>
            </div>

            <div class="form-group">
                <label for="beds_number">* Beds number:</label>
                <input type="number" class="form-control" id="beds_number" name="beds_number" min="1" placeholder="Inserisci il numero di letti" required>
            </div>

            <div class="form-group">
                <label for="bathrooms_number">* Bathrooms number:</label>
                <input type="number" class="form-control" id="bathrooms_number" name="bathrooms_number" min="1" placeholder="Inserisci il numero di bagni" required>
            </div>

            <div class="form-group">
                <label for="square_meters">Square meters:</label>
                <input type="number" class="form-control" id="square_meters" name="square_meters" min="1" placeholder="Inserisci i metri quadrati">
            </div>

            <div class="form-group">
                <label for="image">* Images:</label>
                <input type="file" class="form-control-file" id="image" name="image[]" multiple required>
            </div>

            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="visible" id="noVisible" value="0">
                    <label class="form-check-label" for="noVisible">
                      Hidden
                    </label>
                </div>

                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="visible" id="visible" value="1" checked>
                    <label class="form-check-label" for="visible">
                      Visible
                    </label>
                </div>

            </div>



            <button class="btn btn-success w-25 b-rounded-3" style="margin: 10px auto;" type="submit" src="{{route('admin.habitations.store')}}">
                Create
            </button>

          </form>

    </div>



@endsection
