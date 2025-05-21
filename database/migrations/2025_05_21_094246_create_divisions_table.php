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
        Schema::create('divisions', function (Blueprint $table) {
            $table->string('DivShort', 7)->primary();
            $table->string('DivLong', 55)->nullable();
            $table->string('InstShort', 10)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
