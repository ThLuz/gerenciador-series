<x-layout title="Episodios" :mensagem-sucesso="$mensagemSucesso">
  <form method="post">
    @csrf
    <ul class="list-group mb-4 mt-4">
      @foreach ($episodes as $episode)
      <li class="list-group-item d-flex justify-content-between align-items-center">
          Episódio {{ $episode->number }}

          <input type="checkbox" name="episodes[]" value="{{ $episode->id }}" @if ($episode->watched) checked @endif>
      </li>
      @endforeach
    </ul>
    <button class="btn btn-primary mb-4">Salvar</button>
    <a href="{{ route('seasons.index', $season->series->id) }}" class="btn btn-primary mb-4">Voltar</a>
  </form>
</x-layout>
