<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_out', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20);
            $table->unsignedBigInteger('inventory_in_id');
            $table->date('inventory_date');
            $table->integer('batch_code');
            $table->string('shelf_name');
            $table->integer('initial_stock');
            $table->integer('stock_sold')->nullable();
            $table->decimal('unit_price', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_out');
    }
};
