<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parametros', function (Blueprint $table) {
            $table->unsignedBigInteger('parLiderTipParFk');
            $table->unsignedBigInteger('parViceLiderTipParFk');
            $table->unsignedBigInteger('parParticipanteTipParFk');

            $table->foreign('parLiderTipParFk')->references('tipParpk')->on('tipoParticipante');
            $table->foreign('parViceLiderTipParFk')->references('tipParpk')->on('tipoParticipante');
            $table->foreign('parParticipanteTipParFk')->references('tipParpk')->on('tipoParticipante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
