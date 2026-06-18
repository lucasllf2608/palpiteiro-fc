<?php 

namespace App\Services;

use App\Models\Palpite;
use App\Models\Jogo;
use Exception;

class PalpiteService {

    public function registrar($dados, $userId){
        $jogo = Jogo::findOrFail($dados['jogo_id']);

        if(now()->greaterThan($jogo->data_jogo)){
            throw new Exception("Não é possível palpitar em um jogo que já começou!");
        }

        return Palpite::updateOrCreate(
            ['user_id' => $userId,'jogo_id' => $jogo->id],
            ['gols_casa' => $dados['gols_casa'],'gols_visitante' => $dados['gols_visitante']]);
    }


    public function listarPorUsuario(int $idUsuario){
        return Palpite::with('jogo')->where('user_id', $idUsuario)->orderBy('created_at', 'desc')->get();
    }
}