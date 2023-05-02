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
            $table->foreignId('family_id')->constrained();
            // $table->string('bwilaya', config('rules.wilaya.max'));
            $table->string('bwilaya');
            $table->string('ar_fname', config('rules.ar_fname.max'))->nullable();
            $table->string('ar_lname', config('rules.ar_lname.max'))->nullable();
            $table->date('bday');
            $table->string('bplace', config('rules.bplace.max'));
            $table->string('sex', config('rules.sex.max'));
            $table->string('nationality', config('rules.nationality.max'));
            //
            $table->timestamps();
            $table->softDeletes();
            //
            // $table->foreign('bwilaya')->references('name')->on('wilayas');
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
