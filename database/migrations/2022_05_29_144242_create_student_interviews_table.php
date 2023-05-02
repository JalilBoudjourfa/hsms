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
        Schema::create('student_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_registration_id')->constrained();
            //
            $table->dateTime('schedule');
            $table->string('participants', config('rules.registration_interview_participant.max'));
            $table->string('interrogators', config('rules.full_name.max'));
            $table->boolean('father')->default(0);
            $table->boolean('mother')->default(0);
            $table->string('conclusion', config('rules.registration_interview_conclusion.max'))->nullable();
            $table->string('title', 64)->nullable();
            $table->string('note', 512)->nullable();
            $table->enum('type', ['registration', 'payement']);
            //
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('student_interviews');
    }
};
