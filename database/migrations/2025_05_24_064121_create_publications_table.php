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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // 'patent', 'book', 'journal', 'conference'

            $table->string('title')->nullable();
            $table->json('authors')->nullable();

            // Patent-specific
            $table->string('registration_number')->nullable();
            $table->date('date_of_registration')->nullable();
            $table->string('country_of_origin')->nullable();

            // Book-specific
            $table->string('book_title')->nullable();
            $table->string('publisher')->nullable();
            $table->date('publication_date')->nullable();

            // Journal-specific
            $table->string('journal_name')->nullable();
            $table->string('volume_no')->nullable();
            $table->string('issue_no')->nullable();
            $table->string('page')->nullable();
            $table->date('publish_date')->nullable();

            // Conference-specific
            $table->string('conf_name')->nullable();
            $table->date('held_in')->nullable();
            $table->string('country')->nullable();

            // Common
            $table->string('url')->nullable();

            // Relations
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
        Schema::dropIfExists('publications');
    }
};
