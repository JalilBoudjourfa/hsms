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
        Schema::create('expense_types', function (Blueprint $table) {
            $table->id();
            //
            $table->string('name')->unique();
            //
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * @author medilies
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_types');
    }
};
