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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('plaque');
            $table->string('marque', 60);
            $table->date('year')->nullable();
            $table->string('carburateur', 30)->nullable();
            $table->string('model', 30)->nullable();
            $table->double('inf', 20, 3)->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->boolean('lock')->nullable()->default(false);
            $table->string('color', 10)->nullable();
            $table->string('veh_id_number')->nullable()->default('N/N');
            $table->bigInteger('user_id')->unsigned();
            $table->json('rose_card')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
