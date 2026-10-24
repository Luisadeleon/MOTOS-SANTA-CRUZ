<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas')->cascadeOnDelete();
            $table->foreignId('producto_id')->nullable()->constrained('productos')->restrictOnDelete();
            $table->foreignId('servicio_id')->nullable()->constrained('servicios')->restrictOnDelete();
            $table->unsignedInteger('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        // Cada línea es un producto o un servicio, nunca ambos ni ninguno.
        DB::statement('ALTER TABLE detalle_ventas ADD CONSTRAINT chk_producto_o_servicio CHECK (
            (producto_id IS NOT NULL AND servicio_id IS NULL) OR
            (producto_id IS NULL AND servicio_id IS NOT NULL)
        )');
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
