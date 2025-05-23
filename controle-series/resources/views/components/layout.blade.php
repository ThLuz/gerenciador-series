<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }} - Controle de Séries</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="{{ mix('css/estilos.css') }}">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a href="{{ route('series.index') }}" class="navbar-brand">Séries</a>
      @auth
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button class="btn btn-link">Sair</button>
        </form>
      @endauth
      @if (Route::currentRouteName() !== 'login' && Auth::guest())
        <a href="{{ route('login') }}">Entrar</a>
      @endif
    </div>
  </nav>
  <div class="container">
    <h1>{{ $title }}</h1>

    @isset($mensagemSucesso)
      <div class="alert alert-success">
        {{ $mensagemSucesso }}
      </div>
    @endisset

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{ $slot }}
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>


</html>