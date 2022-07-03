@extends('layouts.app')

@section('content')

    <div>

        <form action="{{ route('admin.habitations.store')}}" method="POST" enctype="multipart/form-data">
              @csrf

            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" placeholder="Inserisci il titolo" name="title" maxlength="100" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" min="1" max="99999" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" class="form-control" id="latitude" name="latitude" min="-90" max="90" step="0.00001" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" class="form-control" id="longitude" name="longitude" min="-180" max="180" step="0.00001" required>
            </div>
            <div class="form-group">
                <label for="guests_number">Guests number</label>
                <input type="number" class="form-control" id="guests_number" name="guests_number" min="1" required>
            </div>
            <div class="form-group">
                <label for="rooms_number">Rooms number</label>
                <input type="number" class="form-control" id="rooms_number" name="rooms_number" min="1" required>
            </div>
            <div class="form-group">
                <label for="beds_number">Beds number</label>
                <input type="number" class="form-control" id="beds_number" name="beds_number" min="1" required>
            </div>
            <div class="form-group">
                <label for="bathrooms_number">Bathrooms number</label>
                <input type="number" class="form-control" id="bathrooms_number" name="bathrooms_number" min="1" required>
            </div>
            <div class="form-group">
                <label for="square_meters">Square meters</label>
                <input type="number" class="form-control" id="square_meters" name="square_meters" min="1">
            </div>
            <div class="form-group">
                <label for="image">image</label>
                <input type="file" multiple class="form-control-file" id="image" name="image[]" required>
            </div>


            <div class="form-group">
              <label for="exampleFormControlSelect1">Example select</label>
              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>


            <button class="btn btn-success w-25 b-rounded-3" style="margin: 10px auto;" type="submit" src="{{route('admin.habitations.store')}}">
                Create
            </button>

          </form>

    </div>



@endsection
