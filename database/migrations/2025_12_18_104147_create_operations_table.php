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
        Schema::create('operations', function (Blueprint $table) {

    $table->id();
    $table->string('operation_type');
    $table->string('number');
    $table->date('date');
    $table->string('status')->default('posted');

    $table->unsignedBigInteger('warehouse_id');
    $table->unsignedBigInteger('partner_id')->nullable();
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('related_operation_id')->nullable();

    $table->timestamps();

    $table->foreign('warehouse_id')->references('id')->on('warehouses');
    $table->foreign('partner_id')->references('id')->on('partners');
    $table->foreign('user_id')->references('id')->on('users');
    $table->foreign('related_operation_id')->references('id')->on('operations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
