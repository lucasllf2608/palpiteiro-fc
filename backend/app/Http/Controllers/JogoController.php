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
    public function index() {
       $jogos = Jogo::orderBy('data_jogo', 'asc')->get();
       return response()->json($jogos, 200);
    }


    public function encerrarPartida(Request $request, $id){

        $dadosValidados = $request->validate([
                'gols_casa' => 'required|integer|min:0',
                'gols_visitante' => 'required|integer|min:0',
                ]);

        try {
            $jogo = $this->jogoService->finalizarPartida($id, $dadosValidados);
            return response()->json(['mensagem' => 'Jogo encerrado e pontos dos usuários calculados com sucesso!','jogo' => $jogo], 200);
        } catch (Exception $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }

    }





}
