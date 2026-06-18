<?php

namespace App\Services;

use App\Models\Jogo;
use App\Models\Palpite;
use Exception;

class JogoService {

    public function finalizarPartida(int $jogoId, array $dadosReais){
        $jogo = Jogo::findOrFail($jogoId);

        if($jogo->status == 'finalizado'){
            throw new Exception("Este jogo já foi encerrado anteriormente!");
        }

       $jogo->update([
            'gols_casa' => $dadosReais['gols_casa'],
            'gols_visitante' => $dadosReais['gols_visitante'],
            'status' => 'finalizado'
        ]);

        $palpites = Palpite::where('jogo_id', $jogoId)->get();

        foreach ($palpites as $palpite) {
            $pontos = $this->calcularPontuacao($palpite, $dadosReais);
            $palpite->update(['pontos_ganhos' => $pontos]);
        }

        return $jogo;
    }


    public function calcularPontuacao(Palpite $palpite, array $dadosReais): int {
        $pontos = 0;
        $golsCasaReal = $dadosReais['gols_casa'];
        $golsVisitanteReal = $dadosReais['gols_visitante'];

        $golsCasaPalpite = $palpite->gols_casa;
        $golsVisitantePalpite = $palpite->gols_visitante;

        $tendenciaReal = $golsCasaReal > $golsVisitanteReal ? 1 : ($golsCasaReal < $golsVisitanteReal ? 2 : 0);

        $tendenciaPalpite = $golsCasaPalpite > $golsVisitantePalpite ? 1 : ($golsCasaPalpite < $golsVisitantePalpite ? 2 : 0); 
        
        $acertouTendencia = false;
        if($tendenciaReal === $tendenciaPalpite){
            $pontos += 5;
            $acertouTendencia = true;
        }    

        $acertouGolsCasa = false;
        if ($golsCasaPalpite === $golsCasaReal) {
            $pontos += 2;
            $acertouGolsCasa = true;
        }

        $acertouGolsVisitante = false;
        if ($golsVisitantePalpite === $golsVisitanteReal) {
            $pontos += 2;
            $acertouGolsVisitante = true;
        }

        if ($acertouTendencia && $acertouGolsCasa && $acertouGolsVisitante) {
            $pontos += 3;
        }

        return $pontos;
    }

}

