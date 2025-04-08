<x-layout title="Nova Série">
  <form action="{{ route('series.store') }}" method="post">
    @csrf
    <div class="mb-3">
      <label for="nome" class="form-label">Nome:</label>
      <input type="text" class="form-control" name="nome" id="nome">
    </div>
    <button type="submit" class="btn btn-primary">Adicionar</button>
    <a href="{{ route('series.index') }}" class="btn btn-primary">Voltar</a>
  </form>

</x-layout>