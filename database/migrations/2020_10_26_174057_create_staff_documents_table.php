<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_documents', function (Blueprint $table) {
            $table->id();
            $table->string('aadhar_card')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('resume')->nullable();
            $table->string('address_proof')->nullable();

            $table->bigInteger('staff_id')->unsigned();
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
        Schema::dropIfExists('staff_documents');
    }
}
