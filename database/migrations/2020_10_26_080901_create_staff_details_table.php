<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_details', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('contact1');
            $table->unsignedBigInteger('contact2')->nullable();
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('aadhar_no')->unique()->nullable();
            $table->string('picture')->nullable();
            $table->enum('gender',['male','female','other']);
            $table->enum('caste',['GEN-EWS','SC','ST','OBC-NCL','other'])->nullable();
            $table->enum('marital_status',['married','unmarried'])->nullable();
            $table->string('nationality');
            $table->tinyInteger('experience')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('job_quit_reason')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->unsignedBigInteger('guardian_contact')->nullable();
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
        Schema::dropIfExists('staff_details');
    }
}
