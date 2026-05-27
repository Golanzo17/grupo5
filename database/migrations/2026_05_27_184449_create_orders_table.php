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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->string('estado')->default('pendiente'); // pendiente, completado, cancelado
            $table->string('metodo_pago'); // transferencia, tarjeta
            $table->string('tipo_entrega'); // envio, local
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
