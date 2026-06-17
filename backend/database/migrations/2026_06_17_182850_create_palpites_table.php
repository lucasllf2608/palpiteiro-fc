<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palpites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jogo_id')->constrained()->onDelete('cascade');
            $table->integer('gols_casa');
            $table->integer('gols_visitante');
            $table->integer('pontos_ganhos')->nullabel()->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'jogo_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palpites');
    }
};

