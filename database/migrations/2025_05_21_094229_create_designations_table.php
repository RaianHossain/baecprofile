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
        Schema::create('designations', function (Blueprint $table) {
            $table->string('DesigShort', 30)->primary();
            $table->string('DesigLong', 50)->nullable();
            $table->float('DesigWeight', 4, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
