<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @author medilies
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establishment_year_id')->constrained();
            $table->foreignId('classroom_id')->nullable()->constrained();
            //
            $table->string('name', 32);
            $table->unsignedSmallInteger('capacity_max');
            $table->unsignedSmallInteger('capacity_min');
            //
            $table->timestamps();
            $table->softDeletes();
            //
            $table->unique(['establishment_year_id', 'name']);
        });
    }

    /**
     * @author medilies
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
