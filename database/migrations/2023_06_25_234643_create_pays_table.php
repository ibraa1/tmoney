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
        Schema::disableForeignKeyConstraints();
        Schema::create('payss', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code');
            $table->unsignedBigInteger('creation_user_id')->nullable();
            $table->unsignedBigInteger('modification_user_id')->nullable();
            // Foreign key constraints
            $table->foreign('creation_user_id')->references('id')->on('users');
            $table->foreign('modification_user_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
