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
        Schema::create('stock_movements', function (Blueprint $table) {

    $table->id();
    $table->unsignedBigInteger('operation_id');
    $table->unsignedBigInteger('warehouse_id');
    $table->unsignedBigInteger('item_id');
    $table->integer('quantity_change');
    $table->unsignedInteger('balance_after');
    $table->timestamps();

    $table->foreign('operation_id')->references('id')->on('operations')->onDelete('restrict');
    $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('restrict');
    $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
