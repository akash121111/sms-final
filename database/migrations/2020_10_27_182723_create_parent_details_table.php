<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_details', function (Blueprint $table) {
            $table->id();
            $table->string('father_name');
            $table->unsignedBigInteger('father_contact1');
            $table->unsignedBigInteger('father_contact2')->nullable();
            $table->string('father_email')->unique();
            $table->date('father_dob')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_picture')->nullable();

            $table->string('mother_name');
            $table->unsignedBigInteger('mother_contact1');
            $table->unsignedBigInteger('mother_contact2')->nullable();
            $table->string('mother_email')->unique()->nullable();
            $table->date('mother_dob')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_picture')->nullable();

            $table->string('local_gardian_name')->nullable();
            $table->unsignedBigInteger('local_gardian_contact')->nullable();
            $table->string('local_gardian_email')->unique()->nullable();

            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
        
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
        Schema::dropIfExists('parent_details');
    }
}
