@extends('layouts.app')

@section('title', 'Autorizācija')

@section('content')
        <main class="authorization">
            <div class="signin-container">
                <h2>Log in</h2>
                <p id="access-account">Access your account</p>

                <form action="{{ route('login') }}" method="POST" id="authorization-form">
                    @csrf

                    <label for="email">E-mail address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="error-message">
                        <img src="{{ asset('styles/icons/icon=error.svg') }}" alt="error"> {{ $message }}
                    </div>
                    @enderror

                    <label for="password">Enter password</label>
                    <input type="password" name="password" id="password" required>
                    @error('password')
                    <div class="error-message">
                        <img src="{{ asset('styles/icons/icon=error.svg') }}" alt="error"> {{ $message }}
                    </div>
                    @enderror

                    @if(session('login_error'))
                        <div class="error-message">
                            <img src="{{ asset('styles/icons/icon=error.svg') }}" alt="error"> {{ session('login_error') }}
                        </div>
                    @endif

                    <button id="loginButton" type="submit">Log in</button>
                </form>

                <p id="no-account">Don't have an account? <a href="{{ route('register.form') }}">Create</a></p>
            </div>
        </main>
@endsection
