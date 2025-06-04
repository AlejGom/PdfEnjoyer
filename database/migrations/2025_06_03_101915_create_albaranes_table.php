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
        Schema::create('albaranes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');       // Ex. AC25/0760
            $table->string('subnombre');    // Albarán empresa X
            $table->string('archivo');      // PDF Ref.
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albaranes');
    }
};
