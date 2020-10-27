<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->enum('adreess_type',['local','permanent']);
            $table->string('house_number')->nullable();
            $table->string('street');   
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('postal_code');
            $table->string('near_by')->nullable();
    
            $table->bigInteger('staff_id')->unsigned()->nullable();
            $table->foreign('staff_id')->references('id')->on('staff_details');

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
        Schema::dropIfExists('addresses');
    }
}
