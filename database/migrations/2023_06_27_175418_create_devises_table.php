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
        Schema::create('devises', function (Blueprint $table) {
            $table->id();
            $table->string('frequence');
            $table->string('deviseEntree');
            $table->string('deviseSortie');
            $table->decimal('courDevise', 15, 9);
            $table->date('dateDebut');
            $table->date('dateFin')->nullable();
            $table->unsignedBigInteger('creationUserId');
            $table->unsignedBigInteger('modificationUserId');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('creationUserId')->references('id')->on('users');
            $table->foreign('modificationUserId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devises');
    }
};
