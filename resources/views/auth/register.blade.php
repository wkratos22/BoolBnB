@extends('layouts.app')

@section('title')
    Registrati
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-start align-items-sm-center my-4 my-sm-0" style="height: 85%">
    <div class="row justify-content-center w-100">
        <div class="card c_border rounded_lg" style="width: 75%; margin: 0 auto;">
            <div class="card-header c_border h5 bg-white rounded_top">{{ __('Registrati') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <small class="form-text text-muted mb-3">* Campo obbligatorio</small>

                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">{{ __('Nome *') }}</label>

                        <div>
                            <input id="name" type="text" class="c_border shadow-none form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="surname" class="col-form-label text-md-right">{{ __('Cognome *') }}</label>

                        <div>
                            <input id="surname" type="text" class="c_border shadow-none form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail *') }}</label>

                        <div>
                            <input id="email" type="email" class="c_border shadow-none form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth" class="col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                        <div>
                            <input id="date_of_birth" type="date" class="c_border shadow-none form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="date_of_birth">

                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-right">{{ __('Password *') }}</label>

                        <div>
                            <input id="password" type="password" class="c_border shadow-none form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                        <div>
                            <input id="password-confirm" type="password" class=" c_border shadow-none form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group mb-0 mt-5">
                        <div class="text-center">
                            <button type="submit" class="btn color_button shadow-none">
                                {{ __('Registrati') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
