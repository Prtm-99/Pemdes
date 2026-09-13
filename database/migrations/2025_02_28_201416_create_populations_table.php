<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('populations', function (Blueprint $table) {
            $table->id();
            
            // Jumlah Penduduk
            $table->integer('male');
            $table->integer('female');
            
            // Jumlah Kematian & Kelahiran
            $table->integer('deaths');
            $table->integer('births');
            
            // Jumlah Agama
            $table->integer('islam');
            $table->integer('christian');
            $table->integer('catholic');
            $table->integer('hindu');
            $table->integer('buddha');
            $table->integer('confucianism');
            
            // Jumlah Bekerja
            $table->integer('employed');
            $table->integer('unemployed');
            $table->integer('housewife');
            $table->integer('student');
            
            // Jumlah Transmisi
            $table->integer('migration_in');
            $table->integer('migration_out');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('populations');
    }
};
