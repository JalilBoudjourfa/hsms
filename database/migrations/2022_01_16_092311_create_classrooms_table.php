<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_type_id')->constrained();
            $table->foreignId('establishment_year_id')->constrained()->onDelete('cascade');
            //
            $table->boolean('active')->default(false);
            //
            $table->timestamps();
            $table->softDeletes();
            //
            $table->unique(['class_type_id', 'establishment_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
