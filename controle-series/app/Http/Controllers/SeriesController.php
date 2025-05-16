<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticator;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware('auth')->except('index');
    }

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

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->add($request);

        $email = new SeriesCreated($serie->nome, $serie->id, $request->seasonsQty, $request->episodesPerSeason);
        Mail::to($request->user())->send($email);

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
