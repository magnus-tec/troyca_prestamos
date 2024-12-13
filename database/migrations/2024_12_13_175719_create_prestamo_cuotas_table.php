<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamoCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo_cuotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamos_id')->nullable()->constrained('prestamos')->onDelete('cascade');
            $table->date('fecha_pago');
            $table->date('fecha_vencimiento');
            $table->decimal('cuota', 10, 2);
            $table->decimal('saldo_capital', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('ted', 10, 2);
            $table->decimal('monto_pago', 10, 2);
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamo_cuotas');
    }
}
