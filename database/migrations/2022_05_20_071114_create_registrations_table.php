<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('school_year');
            $table->tinyInteger('level');
            $table->string('university_id');
            $table->foreignId('student_id')->constrained()->onUpdate('cascade');
            $table->foreignId('faculty_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('institute_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreign('university_id')->references('universities')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
};
