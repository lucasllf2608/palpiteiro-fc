<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_casa',
        'time_visitante',
        'campeonato',
        'gols_casa',
        'gols_visitante',
        'data_jogo',
        'status'
    ];
}
