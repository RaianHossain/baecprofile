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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('conf_name', 55)->nullable();
            $table->string('organizer')->nullable();
            $table->string('title')->nullable();
            $table->date('held_from')->nullable();
            $table->date('held_to')->nullable();
            $table->string('venue')->nullable();
            $table->string('country')->nullable();
            $table->string('contribution')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('EmpId', 5)->nullable(); // Adjust length as per employees.EmpID
            $table->foreign('EmpId')->references('EmpID')->on('employees')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
