<x-layout title="Editar Série {{ $serie->Nome }}">
  <x-series.form :action="route('series.update', $serie->id)" :nome="$serie->Nome" :update="true"/>
</x-layout>