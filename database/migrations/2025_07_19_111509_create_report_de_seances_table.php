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
        Schema::create('report_de_seances', function (Blueprint $table) {
            $table->id();
            // séance reportée
            $table->foreignId('seance_reportee_id')->constrained('seances')->onDelete('cascade');
            // séance qui remplace
            $table->foreignId('seance_report_id')->constrained('seances')->onDelete('cascade');
            $table->date('date'); // nouvelle date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_de_seances');
    }
};
