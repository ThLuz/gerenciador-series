<x-layout title="Nova Série">
  <!-- <x-series.form :action="route('series.store')" :nome="old('nome')" :update="false"/> -->

  <form action="{{ route('series.store') }}" method="post">
    @csrf

    <div class="row mb-3">
      <div class="col-8">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" class="form-control" autofocus name="nome" id="nome" value="{{ old('nome') }}">
      </div>
      <div class="col-2">
        <label for="seasonsQty" class="form-label">Nº Temporadas:</label>
        <input type="text" class="form-control" name="seasonsQty" id="seasonsQty" value="{{ old('seasonsQty') }}">
      </div>
      <div class="col-2">
        <label for="episodesPerSeason" class="form-label">Eps / Temporadas:</label>
        <input type="text" class="form-control" name="episodesPerSeason" id="episodesPerSeason" value="{{ old('episodesPerSeason') }}">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Adicionar</button>
    <a href="{{ route('series.index') }}" class="btn btn-primary">Voltar</a>
  </form>


</x-layout>