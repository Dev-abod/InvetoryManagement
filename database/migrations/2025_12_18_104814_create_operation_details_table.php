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
        Schema::create('operation_details', function (Blueprint $table) {

    $table->id();
    $table->unsignedBigInteger('operation_id');
    $table->unsignedBigInteger('item_id');
    $table->unsignedInteger('quantity');
    $table->timestamps();

    $table->foreign('operation_id')->references('id')->on('operations');
    $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_details');
    }
};
