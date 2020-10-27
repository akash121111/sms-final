<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_qualifications', function (Blueprint $table) {
            $table->id();
            $table->enum('qualification_type',['10th','12th','graduate','post garduate','others'])->nullable();
            $table->string('qualification')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('board_name')->nullable();
            $table->tinyInteger('percentage')->nullable();
            $table->tinyInteger('year')->nullable();

            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->foreign('staff_id')->references('id')->on('staff_details');
            
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
        Schema::dropIfExists('staff_qualifications');
    }
}
