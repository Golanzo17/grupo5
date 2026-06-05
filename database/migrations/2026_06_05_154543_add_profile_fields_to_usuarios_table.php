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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('apellido')->nullable()->after('nombre');
            $table->string('telefono', 20)->nullable()->after('email');
            $table->string('direccion')->nullable()->after('telefono');
            $table->string('ciudad')->nullable()->after('direccion');
            $table->string('codigo_postal', 20)->nullable()->after('ciudad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn(['apellido', 'telefono', 'direccion', 'ciudad', 'codigo_postal']);
        });
    }
};
