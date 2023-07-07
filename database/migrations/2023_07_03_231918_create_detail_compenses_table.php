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
        Schema::create('detail_compenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compenseId');
            $table->unsignedBigInteger('deviseId');
            $table->decimal('montant');
            $table->enum('type', ['retraitBalance', 'commission', 'transfertBalance']);
            $table->enum('modePaiement', ['autres', 'espèce', 'mobileMoney', 'transfert', 'balance']);
            $table->unsignedBigInteger('creationUserId');
            $table->unsignedBigInteger('modificationUserId');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('compenseId')->references('id')->on('compenses')->onDelete('cascade');
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
        Schema::dropIfExists('detail_compenses');
    }
};
