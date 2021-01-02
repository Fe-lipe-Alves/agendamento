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

            {{ printf($errors) }}

            </div>
            <div class="col-10 offset-1 col-md-4 offset-md-0 h-100 d-flex flex-wrap box-shadow">
                <form method="POST" action="{{ route('login') }}" class="row align-self-center">
                    @csrf
                    <div class="col-12 my-4 my-md-5">
                        <h1 class="text-center">StackWeb</h1>
                    </div>
                    <div class="col-10 col-lg-10 col-xl-8 offset-1 offset-lg-1 offset-xl-2 form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-10 col-lg-10 col-xl-8 offset-1 offset-lg-1 offset-xl-2 form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="password" id="senha" class="form-control" required autocomplete="current-password">
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
