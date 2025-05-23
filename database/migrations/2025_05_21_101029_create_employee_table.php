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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('EmpID', 5)->primary();
            $table->string('EmpTitle', 5)->nullable();
            $table->string('EmpFname', 30)->nullable();
            $table->string('EmpLname', 15)->nullable();
            $table->float('EmpRank', 5, 3)->default(9.999);
            $table->string('EmpPhone', 15)->nullable();
            $table->string('EmpEmail', 40)->nullable();
            $table->date('JoiningDate')->nullable();
            $table->string('BatchMerit', 50)->nullable();
            $table->string('Photo', 100)->nullable();
            $table->string('Image', 100)->nullable();
            $table->string('DivShort')->nullable();
            $table->string('InstShort')->nullable();
            $table->string('DesigShort')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->timestamps();      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
