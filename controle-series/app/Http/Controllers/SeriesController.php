<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request) {
        //$series = Serie::query()->orderBy('Nome')->get();
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');
        //$request->session()->forget('mensagem.sucesso'); //--flash()
        
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create() {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) {

        $serie = Series::create($request->all());
        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++){
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach($serie->seasons as $season){
            for ($j = 1; $j <= $request->episodesPerSeason; $j++){
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);

        //$request->session()->flash('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");

        //DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);
        return to_route('series.index')->with('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");

    }

    public function destroy(Series $series, Request $request) {
        //Serie::destroy($series->id);
        $series->delete();
        //$request->session()->flash('mensagem.sucesso', "Série {$series->Nome} removida com sucesso");

        return to_route('series.index')->with('mensagem.sucesso', "Série {$series->Nome} removida com sucesso");
    }

    public function edit(Series $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request){
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série {$series->nome} atualizada com sucesso");
    }
}
