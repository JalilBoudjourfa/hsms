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
        Schema::create('classroom_expense', function (Blueprint $table) {
            $table->timestamps();
            //
            $table->foreignId('expense_id')->constrained();
            $table->foreignId('classroom_id')->constrained();
        });
    }

    /**
     * @author medilies
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_expense');
    }
};
