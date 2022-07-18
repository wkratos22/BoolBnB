@extends('layouts.app')

@section('title')
    Sponsorizzazione
@endsection

@section('content')

<div class="container h-100">
    <div class="row row-cols-1 row-cols-lg-3 align-items-center h-100">
        @foreach ($sponsorships as $sponsorship)
        <div class="col">
            <div class="card text-center c_border rounded_lg">
                <div class="card-header bg-white c_border rounded_top">
                    <h4 class="card-title">{{$sponsorship->name}}</h4>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Durata: {{$sponsorship->duration}} ore</h5>
                  <h6 class="card-text">Prezzo: {{$sponsorship->price}}€</h6>
                  <div class="pt-4">
                    <a href="{{ route('admin.pay', [$habitation, $sponsorship])}}" class="btn color_button shadow-none">Scegli</a> 
                  </div>
                  
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

