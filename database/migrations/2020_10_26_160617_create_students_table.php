<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('contact')->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('aadhar_no')->unique()->nullable();
            $table->string('picture')->nullable();
            $table->string('family_picture')->nullable();
            $table->enum('gender',['male','female','other']);
            $table->enum('caste',['GEN-EWS','SC','ST','OBC-NCL','other'])->nullable();
            $table->string('nationality');
            $table->string('place_of_birth')->nullable();
            $table->enum('blood_group',['O-','O+','A+','A-','B+','B-','AB+','AB-'])->nullable();
            $table->string('previous_school')->nullable();
            $table->tinyInteger('previous_class')->nullable();
            $table->string('leaving_reason')->nullable();
            $table->string('refrence')->nullable();
            $table->boolean('is_confirmed')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
}
