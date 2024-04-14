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
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();

            $table->string('observation');
            $table->date('date_affectation');
            $table->unsignedBigInteger('puce')->index();
            $table->unsignedBigInteger('personnel')->index();
            $table->foreign('puce')->references('id')->on('puces');
            $table->foreign('personnel')->references('id')->on('personnels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectation');
    }
};
