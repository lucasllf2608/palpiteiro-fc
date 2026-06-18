<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PalpiteService;
use Exception;

class PalpiteController extends Controller {
    protected $palpiteService;

    public function __construct(PalpiteService $palpiteService){
        $this->palpiteService = $palpiteService;
    }


    public function index(){
        try {
            $palpites = $this->palpiteService->listarPorUsuario(auth()->id());
            return response()->json($palpites,200);
        } catch (Exception $th) {
          return response()->json(['erro' => 'Não foi possível buscar os palpites.'], 500);
        }
    }


    public function store(Request $request){
        $dadosValidados = $request->validate([
            'jogo_id'=>'required|integer',
            'gols_casa'=>'required|integer|min:0',
            'gols_visitante'=> 'required|integer|min:0',
        ]);

        try {
            $palpite = $this->palpiteService->registrar($dadosValidados, auth()->id());

            return response()->json(['mensagem' => 'Palpite registrado com sucesso!','dados'    => $palpite], 200);

        } catch (Exception $e) {
           return response()->json([
                'erro' => $e->getMessage()], 400);
        }

    }
}
