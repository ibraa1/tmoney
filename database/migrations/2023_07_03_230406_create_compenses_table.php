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
        Schema::create('compenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->enum('statut', ['en attente', 'validé', 'réjeté']);
            $table->dateTime('dateInitiation');
            $table->dateTime('dateApprobation')->nullable();
            $table->unsignedBigInteger('creationUserId');
            $table->unsignedBigInteger('modificationUserId');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('creationUserId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('modificationUserId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compenses');
    }
};
