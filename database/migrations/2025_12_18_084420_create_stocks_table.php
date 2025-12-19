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
        Schema::create('stocks', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('warehouse_id');
    $table->unsignedBigInteger('item_id');
    $table->unsignedInteger('quantity')->default(0);
    $table->timestamps();

    $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('restrict');
    $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
    $table->unique(['warehouse_id', 'item_id']);

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
