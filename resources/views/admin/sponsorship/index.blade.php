@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
        @foreach ($sponsorships as $sponsorship)
            <div class="col">
                <div class="card my-2" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title">{{$sponsorship->name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Durata: {{$sponsorship->duration}} ore</h6>
                    <h6 class="card-text">Prezzo: {{$sponsorship->price}}€</h6>
                    <div class="text-right">
                        <a href="{{ route('admin.pay', [$habitation, $sponsorship])}}" class="btn btn-primary">Sponsorizza</a>
                    </div>
                    
                    </div>
                </div>
            </div>
        @endforeach 
    </div>
</div>
@endsection