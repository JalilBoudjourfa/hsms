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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_id')->constrained();
            $table->foreignId('student_registration_id')->constrained();
            //
            $table->unsignedInteger('paid');
            $table->boolean('ez_mode');
            $table->unsignedInteger('reduction');
            //
            $table->timestamps();
            $table->softDeletes();
            //
            $table->unique(['expense_id', 'student_registration_id'], 'one_reg_to_one_expense');
        });
    }

    /**
     * @author medilies
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
