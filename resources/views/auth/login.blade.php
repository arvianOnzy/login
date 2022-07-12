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
                        <h2 class="text-center mt-4 mb-3">Login</h2>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
    
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input value="{{old('email')}}" type="text" class="form-control @error('') is-invalid @enderror" id="email" name="email" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                            
                                <input value="{{old('password')}}" type="password" class="form-control @error('') is-invalid @enderror" id="inputpassword" name="password" required autocomplete="current-password">
                                
                            </div>
                            <div class="mb-3">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-outline-primary mt-3" style="width: 100%;">Login</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
    </x-guest-layout>