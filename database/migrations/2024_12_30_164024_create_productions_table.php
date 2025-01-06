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
        Schema::create('production', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_user_id');
            $table->unsignedBigInteger('production_user_id')->nullable();
            $table->date('production_date')->nullable();
            $table->date('request_date');
            $table->string('status');
            $table->text('note')->nullable();
            $table->string('approval')->nullable();
            $table->timestamps();

            $table->foreign('inventory_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('production_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production');
    }
};
