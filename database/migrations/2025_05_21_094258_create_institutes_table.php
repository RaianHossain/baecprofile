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
        Schema::create('institutes', function (Blueprint $table) {
            $table->string('InstShort', 15)->primary();
            $table->string('InstLong', 60)->nullable();
            $table->string('InstPlace', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
