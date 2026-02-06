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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('registre_id')->constrained('registres')->onDelete('cascade');
            $table->foreignId('employe_id')->constrained('employes')->onDelete('cascade');
            $table->enum('statut', ['present', 'absent', 'retard'])->nullable();
            $table->time('heure_entree')->nullable();
            $table->time('heure_sortie')->nullable();
            $table->timestamps();

            $table->unique(['date', 'registre_id', 'employe_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
