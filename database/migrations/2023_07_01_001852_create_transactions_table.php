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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['transfert', 'retrait']);
            $table->unsignedBigInteger('agentId');
            $table->unsignedBigInteger('deviseId');
            $table->dateTime('date');
            $table->decimal('commission')->nullable();
            $table->decimal('agentCommission')->nullable();
            $table->decimal('retraitantCommission')->nullable();
            $table->decimal('adminCommission')->nullable();
            $table->decimal('remise')->nullable();
            $table->enum('typeRemise', ['aucun', 'pourcentage', 'valeur'])->nullable();
            $table->unsignedBigInteger('paysId');
            $table->decimal('montant', 15, 3);
            $table->integer('code')->unique()->nullable();
            $table->enum('statut', ['en attente', 'OK', 'annulé'])->nullable();
            $table->unsignedBigInteger('clientId');
            $table->unsignedBigInteger('receveurId');
            $table->unsignedBigInteger('creationUserId');
            $table->unsignedBigInteger('modificationUserId');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('agentId')->references('id')->on('users');
            $table->foreign('deviseId')->references('id')->on('devises');
            $table->foreign('paysId')->references('id')->on('payss');
            $table->foreign('clientId')->references('id')->on('users');
            $table->foreign('receveurId')->references('id')->on('users');
            $table->foreign('creationUserId')->references('id')->on('users');
            $table->foreign('modificationUserId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
