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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('l_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('type')->default('aucun')->nullable();
            $table->string('email')->unique();
            $table->string('category')->default('')->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->string('address')->default('Keshero Goma, NK')->nullable();
            $table->string('country')->nullable()->default('CDF');
            $table->string('avatar')->nullable()->default('assets/img/linux.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
