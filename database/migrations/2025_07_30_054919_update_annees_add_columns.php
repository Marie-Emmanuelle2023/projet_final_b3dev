<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('annees', function (Blueprint $table) {
            $table->date('debut')->nullable()->after('nom');
            $table->date('fin')->nullable()->after('debut');
            $table->boolean('en_cours')->default(false)->after('fin');
        });
    }

    public function down(): void
    {
        Schema::table('annees', function (Blueprint $table) {
            $table->dropColumn(['debut', 'fin', 'en_cours']);
        });
    }
};

