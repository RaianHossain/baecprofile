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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('DivShort')->references('DivShort')->on('divisions')->onDelete('cascade');
            $table->foreign('InstShort')->references('InstShort')->on('institutes')->onDelete('cascade');
            $table->foreign('DesigShort')->references('DesigShort')->on('designations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['DivShort']);
            $table->dropForeign(['InstShort']);
            $table->dropForeign(['DesigShort']);
            $table->dropForeign(['user_id']);
        });
    }
};
