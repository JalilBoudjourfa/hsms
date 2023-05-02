<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained();
            //
            $table->string('cni', config('rules.cni.max'))->nullable()->unique();
            $table->string('address', config('rules.address.max')); // state, city, zip, door ???
            $table->string('profession', config('rules.profession.max'));
            $table->string('family_title', config('rules.family_title.max'));
            //
            $table->string('home_num')->nullable();
            $table->string('whatsapp')->nullable();
            //
            $table->timestamps();
            $table->softDeletes();
            //

            $table->unique(['family_id', 'family_title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
