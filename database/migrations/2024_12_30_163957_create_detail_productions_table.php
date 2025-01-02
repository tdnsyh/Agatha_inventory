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
        Schema::create('detail_production', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20);
            $table->unsignedBigInteger('production_id');
            $table->unsignedBigInteger('product_id');
            $table->string('batch_code')->unique();
            $table->string('shelf_name')->nullable();
            $table->integer('quantity_produced');
            $table->date('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_production');
    }
};
