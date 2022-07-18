@extends('layouts.app')

@section('title')
    Accedi
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-start align-items-sm-center my-4 my-sm-0 h-75">
    <div class="row justify-content-center w-100">
        <div class="card rounded_lg c_border" style="width: 75%; margin: 0 auto;">
            <div class="card-header c_border rounded_top h5 bg-white">{{ __('Login') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div>
                            <input id="email" type="email" class="c_border form-control shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>I dati inseriti non risultano associati a nessun account, riprova.</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password" class="c_border form-control shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>I dati inseriti non risultano associati a nessun account, riprova.</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex flex-column align-items-center flex-md-row justify-content-md-between">
                            <button type="submit" class="btn color_button mt-3 mt-md-0 shadow-none">
                                {{ __('Login') }}
                            </button>

                            <div class="form-check">
                                <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if (Route::has('password.request'))
                            <a class="btn p-3 shadow-none" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
