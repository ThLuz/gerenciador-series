<x-layout title="Temporadas de {!! $series->Nome !!}">
  <ul class="list-group mb-4 mt-4">
    @foreach ($seasons as $season)
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="{{ route('episodes.index', $season->id) }}">
        Temporada {{ $season->number }}
        </a>

      <span class="badge bg-secondary">
        <?php  
          //{{ $season->episodes()->watched()->count() }} / {{ $season->episodes->count() }}
        ?>
        {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
      </span>
    </li>
    @endforeach
  </ul>
  <a href="{{ route('series.index') }}" class="btn btn-primary">Voltar</a>
</x-layout>
