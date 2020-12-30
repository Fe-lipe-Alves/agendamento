{{--
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
--}}


    <!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div id="body" class="container-fluid vh-100">
        <div class="row h-100">
            <div class="col-8 bg-third h-100">

            </div>
            <div class="col-10 offset-1 col-md-4 offset-md-0 h-100 d-flex flex-wrap box-shadow">
                <form action="" class="row align-self-center">
                    <div class="col-12 my-4 my-md-5">
                        <h1 class="text-center">StackWeb</h1>
                    </div>
                    <div class="col-10 col-lg-10 col-xl-8 offset-1 offset-lg-1 offset-xl-2 form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-10 col-lg-10 col-xl-8 offset-1 offset-lg-1 offset-xl-2 form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-10 col-lg-10 col-xl-8 offset-1 offset-lg-1 offset-xl-2">
                        <input type="submit" class="btn btn-primary form-control" value="Entrar">
                    </div>
                    <div class="col-10 col-lg-10 col-xl-8 offset-1 offset-lg-1 offset-xl-2 mt-2">
                        <a href="" class="small">Esqueceu a senha?</a>
                    </div>
                </form>
                <div class="row w-100 align-self-end">
                    <div class="col-12 align-self-end text-center">
                        <small>Todos os direitos reservados</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
