<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_documents', function (Blueprint $table) {
            $table->id();
            $table->string('aadhar_card')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('transfer_certicate')->nullable();
            $table->string('father_aadhar_card')->nullable();
            $table->string('mother_aadhar_card')->nullable();
            $table->string('address_proof')->nullable();

            $table->bigInteger('student_id')->unsigned()->nullable();
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
        Schema::dropIfExists('student_documents');
    }
}
