<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index() {

        $series = Serie::query()->orderBy('Nome')->get();

        return view('series.index')->with('series', $series);
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        Serie::create($request->all());

        //DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);
        return to_route('series.index');

    }
}
