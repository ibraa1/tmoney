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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('image')->nullable()->default('images/users/defaultUserPicture.jpg');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('role', ['agent', 'client', 'admin', 'superAdmin']);
            $table->string('adresse')->nullable();
            $table->integer('login_attempts')->nullable();
            $table->string('numero_tel');
            $table->unsignedBigInteger('pays_id');
            $table->unsignedBigInteger('ville_id')->nullable();;
            $table->unsignedBigInteger('creation_user_id')->nullable();
            $table->unsignedBigInteger('modification_user_id')->nullable();
            // Foreign key constraints
            $table->foreign('pays_id')->references('id')->on('payss');
            $table->foreign('ville_id')->references('id')->on('villes');
            $table->foreign('creation_user_id')->references('id')->on('users');
            $table->foreign('modification_user_id')->references('id')->on('users');
            $table->softDeletes();
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
