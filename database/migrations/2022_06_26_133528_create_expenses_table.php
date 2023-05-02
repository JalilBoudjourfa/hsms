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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->year('year_id');
            $table->string('expense_type')->nullable();
            //
            $table->string('name', 32);
            $table->string('category', 32);
            $table->unsignedInteger('value');
            $table->boolean('mondatory');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('note')->nullable();
            //
            $table->timestamps();
            $table->softDeletes();
            //
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('expense_type')->references('name')->on('expense_types');

            $table->unique(['name', 'year_id']);
        });
    }

    /**
     * @author medilies
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
