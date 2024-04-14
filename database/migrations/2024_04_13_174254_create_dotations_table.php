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
        Schema::create('dotations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->boolean('is_active');
            $table->unsignedBigInteger('puce')->index();
            $table->foreign('puce')->references('id')->on('puces')->restrictOnDelete()->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dotation');
    }
};
