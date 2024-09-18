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
        Schema::create('candidatos', function (Blueprint $table) {
            $table->bigIncrements('canpk');
            $table->string('canCPF', 14)->unique();
            $table->unsignedBigInteger('canCatFk');
            $table->string('canFot');
            $table->timestamps();

            $table->foreign('canCatFk')->references('catpk')->on('categoria')->onDelete('cascade');
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
