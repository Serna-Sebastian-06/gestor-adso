<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Gestor ADSO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            max-width: 980px;
            margin: 24px auto;
            font-family: system-ui
        }

        nav a {
            margin-right: 12px
        }

        .flash {
            background: #e6ffed;
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 10px
        }
    </style>
</head>

<body>
      <nav>
        <a href="{{ route('aprendices.index') }}">
            Aprendices
        </a>
    </nav>
    @if(session('ok'))
    <div class="flash">{{ session('ok') }}</div>@endif
    @yield('content')
</body>

</html>