@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($sponsors as $sponsor)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title">Sponsorizzazione</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Durata: {{$sponsor->duration}} ore</h6>
                    <h6 class="card-text">Prezzo: {{$sponsor->price}}€</h6>
                    <a href="{{ route('admin.payment.pay')}}" class="card-link">Acquista</a>
                    
                    </div>
                </div>
            @endforeach 
        </div>
    </div>
</div>
@endsection