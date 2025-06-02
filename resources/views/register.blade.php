@extends('layouts.app')

@section('title', 'Reģistrācija')

@section('content')
        <main class="registration">
            <div class="create-account-container">
                <h2>Create an account</h2>
                <p id="get-started">Get started with your account</p>
                <p id="required-message"><span id="symbol-required">*</span> indicate the required field.</p>

                <form action="{{ route('register') }}" id="registration-form" method="POST">
                    @csrf

                    <label for="name">Name <span id="symbol-required">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="error-message">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2C6.98 2 2.5 6.48 2.5 12C2.5 17.52 6.98 22 12.5 22C18.02 22 22.5 17.52 22.5 12C22.5 6.48 18.02 2 12.5 2ZM13.5 17H11.5V15H13.5V17ZM13.5 13H11.5V7H13.5V13Z" fill="#1B1B1B"/>
                        </svg> {{ $message }}
                    </div>
                    @enderror

                    <label for="surname">Surname <span id="symbol-required">*</span></label>
                    <input type="text" name="surname" id="surname" value="{{ old('surname') }}" required>
                    @error('surname')
                    <div class="error-message">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2C6.98 2 2.5 6.48 2.5 12C2.5 17.52 6.98 22 12.5 22C18.02 22 22.5 17.52 22.5 12C22.5 6.48 18.02 2 12.5 2ZM13.5 17H11.5V15H13.5V17ZM13.5 13H11.5V7H13.5V13Z" fill="#1B1B1B"/>
                        </svg> {{ $message }}
                    </div>
                    @enderror

                    <label for="email">E-mail address <span id="symbol-required">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="error-message">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2C6.98 2 2.5 6.48 2.5 12C2.5 17.52 6.98 22 12.5 22C18.02 22 22.5 17.52 22.5 12C22.5 6.48 18.02 2 12.5 2ZM13.5 17H11.5V15H13.5V17ZM13.5 13H11.5V7H13.5V13Z" fill="#1B1B1B"/>
                        </svg> {{ $message }}
                    </div>
                    @enderror

                    <label for="password">Enter password <span id="symbol-required">*</span></label>
                    <input type="password" name="password" id="password" required>
                    @error('password')
                    <div class="error-message">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2C6.98 2 2.5 6.48 2.5 12C2.5 17.52 6.98 22 12.5 22C18.02 22 22.5 17.52 22.5 12C22.5 6.48 18.02 2 12.5 2ZM13.5 17H11.5V15H13.5V17ZM13.5 13H11.5V7H13.5V13Z" fill="#1B1B1B"/>
                        </svg> {{ $message }}
                    </div>
                    @enderror

                    <label for="password_confirmation">Repeat password <span id="symbol-required">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                    @error('password_confirmation')
                    <div class="error-message">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2C6.98 2 2.5 6.48 2.5 12C2.5 17.52 6.98 22 12.5 22C18.02 22 22.5 17.52 22.5 12C22.5 6.48 18.02 2 12.5 2ZM13.5 17H11.5V15H13.5V17ZM13.5 13H11.5V7H13.5V13Z" fill="#1B1B1B"/>
                        </svg> {{ $message }}
                    </div>
                    @enderror

                    <button id="registerButton" type="submit">Create an account</button>
                </form>
            </div>
        </main>
@endsection
