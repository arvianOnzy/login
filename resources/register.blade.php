
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
    
                        <form method="POST" action="/tambah-user/store">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input value="{{old('name')}}"style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="name" name="name" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input value="{{old('email')}}"style="border-radius: 10px"  type="text" class="form-control @error('') is-invalid @enderror" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input value="{{old('password')}}"style="border-radius: 10px"  type="password" class="form-control @error('') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation">Ulangi Password</label>
                                <input value="{{old('password')}}"style="border-radius: 10px"  type="password" class="form-control @error('') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required >
                            </div>
                            <div class="mb-3">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                            {{-- <button class="btn btn-outline-primary mt-3" style="width: 100%;">{{ __('Register') }}</button> --}}
                            <x-button class="ml-4">
                                {{ __('Register') }}
                            </x-button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>

