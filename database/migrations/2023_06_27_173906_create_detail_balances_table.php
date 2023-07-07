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
        Schema::create('detail_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('balanceId');
            $table->unsignedBigInteger('deviseId');
            $table->decimal('min', 10, 2);
            $table->decimal('max', 10, 2);
            $table->unsignedBigInteger('creationUserId');
            $table->unsignedBigInteger('modificationUserId');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('balanceId')->references('id')->on('balances')->onDelete('cascade');
            $table->foreign('deviseId')->references('id')->on('devises')->onDelete('cascade');
            $table->foreign('creationUserId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('modificationUserId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_balances');
    }
};
