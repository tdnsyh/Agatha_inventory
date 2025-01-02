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
        Schema::create('production_request', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20);
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->timestamp('request_date');
            $table->integer('quantity_request')->nullable();
            $table->string('status_request')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**,
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_request');
    }
};
