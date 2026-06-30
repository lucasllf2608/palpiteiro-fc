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
       
        try {
           $jogos = $this->jogoService->listarJogos();
           return response()->json($jogos, 200);
        } catch (Exception $e) {
            return response()->json(['erro' => 'Não foi possível carregar a listagem de jogos.'], 500);
        }
    }


    public function listarJogosDeHoje(){
          try {
           $jogos = $this->jogoService->listarJogosDeHoje();
           return response()->json($jogos, 200);
        } catch (Exception $e) {
            return response()->json(['erro' => 'Não foi possível carregar a listagem de jogos.'], 500);
        }
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
