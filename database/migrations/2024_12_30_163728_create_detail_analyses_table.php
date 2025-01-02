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
        Schema::create('detail_analysis', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20);
            $table->unsignedBigInteger('analysis_id');
            $table->unsignedBigInteger('product_id');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_analysis');
    }
};
