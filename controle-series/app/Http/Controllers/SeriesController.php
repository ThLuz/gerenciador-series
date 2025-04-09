<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()->orderBy('Nome')->get();
        $mensagemSucesso = session('mensagem.sucesso');
        //$request->session()->forget('mensagem.sucesso'); //--flash()
        
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        $serie = Serie::create($request->all());
        //$request->session()->flash('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");

        //DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);
        return to_route('series.index')->with('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");

    }

    public function destroy(Serie $series, Request $request) {
        //Serie::destroy($series->id);
        $series->delete();
        //$request->session()->flash('mensagem.sucesso', "Série {$series->Nome} removida com sucesso");

        return to_route('series.index')->with('mensagem.sucesso', "Série {$series->Nome} removida com sucesso");
    }

    public function edit(Serie $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series, Request $request){
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série {$series->nome} atualizada com sucesso");
    }
}
