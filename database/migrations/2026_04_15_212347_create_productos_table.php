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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            // Esta línea relaciona al producto con una categoría
            $table->foreignId('categoria_id')->constrained('categorias'); 
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('precio', 10, 2);
            $table->string('imagen_frente')->nullable();
            $table->string('imagen_espalda')->nullable();
            $table->string('imagen_detalle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
