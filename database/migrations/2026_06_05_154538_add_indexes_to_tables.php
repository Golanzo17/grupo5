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
        Schema::table('productos', function (Blueprint $table) {
            $table->index('categoria_id');
            $table->index('activo');
            $table->index('es_nuevo');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropIndex(['categoria_id']);
            $table->dropIndex(['activo']);
            $table->dropIndex(['es_nuevo']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['estado']);
        });
    }
};
