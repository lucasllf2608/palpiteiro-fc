<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palpite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jogo_id',
        'gols_casa',
        'gols_visitante',
        'pontos_ganhos'
    ];
}
