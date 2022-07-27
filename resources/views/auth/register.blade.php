
<x-guest-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' /> -->
        <link href="{{ asset('css/login/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
        <title>DMS | Login</title>
    </head>
    
    <body>
        <div class="card-login">
            <div class="row" style="height:100%;">
                <div class="col bg-blue text-center">
                    <div class="container left-container">
                        <h2 class="left-welcome">Selamat Datang</h2>
                        <img class="left-image" src="/img/login/undraw_programming_re_kg9v.svg">
                        <h6 class="left-appsname">Dokumen Manajemen Sistem</h6>
                    </div>
                </div>
                <div class="col me-2">
                    <div class="container">
                        <h2 class="text-center mt-4 mb-3">Daftar</h2>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
    
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input value="{{old('name')}}" type="text" class="form-control @error('') is-invalid @enderror" id="name" name="name" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input value="{{old('email')}}" type="text" class="form-control @error('') is-invalid @enderror" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input value="{{old('password')}}" type="password" class="form-control @error('') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation">Ulangi Password</label>
                                <input value="{{old('password')}}" type="password" class="form-control @error('') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required >
                            </div>
                            <div class="mb-3">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                            {{-- <button class="btn btn-outline-primary mt-3" style="width: 100%;">{{ __('Register') }}</button> --}}
                            <button class="btn btn-outline-primary mt-3" style="width: 100%;">
                                {{ __('Register') }}
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
    </x-guest-layout>

    {{-- <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('register') }}">
                @csrf
    
                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />
    
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>
    
                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />
    
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
    
                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>
    
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
    
                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
    
                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
      --}}