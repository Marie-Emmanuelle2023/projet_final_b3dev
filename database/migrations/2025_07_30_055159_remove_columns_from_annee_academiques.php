<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('annee_academiques', function (Blueprint $table) {
            $table->dropColumn(['debut', 'fin', 'en_cours']);
        });
    }

    public function down(): void
    {
        Schema::table('annee_academiques', function (Blueprint $table) {
            $table->date('debut')->nullable();
            $table->date('fin')->nullable();
            $table->boolean('en_cours')->default(false);
        });
    }
};
