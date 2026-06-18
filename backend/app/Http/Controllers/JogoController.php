<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jogo;
use App\Services\JogoService;
use Illuminate\Http\Request;

class JogoController extends Controller
{

    protected $jogoService;

    public function __construct(JogoService $jogoService){
        $this->jogoService = $jogoService;
    }

    public function teste(){
        return response()->json([
            'mensagem' =>'Hello WOrld!'
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $jogos = Jogo::orderBy('data_jogo', 'asc')->get();
       return response()->json($jogos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function show(Jogo $jogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jogo $jogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jogo $jogo)
    {
        //
    }
}
