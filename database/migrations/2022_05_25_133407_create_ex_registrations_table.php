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
        Schema::create('ex_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_registration_id')->constrained();
            $table->foreignId('class_type_id')->nullable()->constrained();
            // $table->string('ex_est_wilaya', config('rules.wilaya.max'));
            $table->string('ex_est_wilaya')->nullable();
            $table->string('establishment_name', config('rules.establishment_name.max'))->nullable();
            $table->string('establishment_type', config('rules.establishment_type.max'))->nullable();
            $table->float('grade_1', 4, 2)->nullable();
            $table->float('grade_2', 4, 2)->nullable();
            $table->float('grade_3', 4, 2)->nullable();
            $table->string('bultin_1')->nullable();
            $table->string('bultin_2')->nullable();
            $table->string('bultin_3')->nullable();
            //
            $table->timestamps();
            $table->softDeletes();
            //
            // $table->foreign('ex_est_wilaya')->references('name')->on('wilayas');
        });
    }

    /**
     * @author medilies
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_registrations');
    }
};
