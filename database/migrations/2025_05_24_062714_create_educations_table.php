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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('degree_name')->nullable();
            $table->string('subject')->nullable();
            $table->year('passing_year')->nullable();
            $table->string('university')->nullable();
            $table->integer('order')->nullable(); // for ordering, latest education first
            $table->string('EmpID', 5)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('EmpID')->references('EmpID')->on('employees')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
