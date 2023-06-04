@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="login">
            <form class="login__form" method="POST" action="{{ route('login') }}">
                @csrf
                @error('email')
                <div class="login__error-section">
                    {{ $message }}
                </div>
                @enderror

                @error('password')
                <div class="login__error-section">
                    {{ $message }}
                </div>
                @enderror
                <div class="login__wrapper">
                    <div class="login__email">
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               placeholder="Email Address">

                    </div>


                    <div class="login__password">

                        <input id="password" type="password"
                               class="@error('password') is-invalid @enderror" name="password" required
                               autocomplete="current-password" placeholder="Password">
                    </div>
                </div>

                <button type="submit" class="custom-btn">
                    {{ __('Вход') }}
                </button>
            </form>
        </div>
    </div>
@endsection
