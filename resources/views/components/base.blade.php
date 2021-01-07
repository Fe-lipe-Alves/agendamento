<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @stack('styles')
</head>
<body>
    <div id="body" class=container-fluid>
        @includeIf('components.header')
        <div id="alerta" class="row"></div>

        <section id="content" class="row my-5">
            @yield('content')
        </section>

        @includeIf('components.footer')
    </div>
<script src="{{ asset('js/jquery.min.js') }}" ></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}" ></script>
@stack('scripts')
</body>
</html>
