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
        Schema::create('fellowships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('funding_authority')->nullable();
            $table->string('field')->nullable();
            $table->date('duration_from')->nullable();
            $table->date('duration_to')->nullable();
            $table->string('organization_name')->nullable();
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
        Schema::dropIfExists('fellowships');
    }
};
