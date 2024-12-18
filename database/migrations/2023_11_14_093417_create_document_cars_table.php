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
        Schema::create('document_cars', function (Blueprint $table) {
            $table->id();
              $table->string('path')->nullable();
            $table->string('expiration')->nullable();
            $table->bigInteger('document_id')->unsigned();
            $table->boolean('is_read')->default(true)->nullable();
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->bigInteger('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_cars');
    }
};
