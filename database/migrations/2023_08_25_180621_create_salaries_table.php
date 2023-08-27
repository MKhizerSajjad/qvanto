<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->unsigned()->indexed()->default(4);
            $table->boolean('is_published')->unsigned()->indexed()->default(false);
            $table->string('year_month', 7)->indexed()->nullable(); // Store YYYY-MM format
            // $table->tinyInteger('month')->unsigned()->indexed()->nullable();
            $table->datetime('dated')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->decimal('total_amount',20,2)->nullable();
            $table->decimal('paid_amount',20,2)->nullable();
            $table->decimal('basic_salary',20,2)->nullable();
            $table->decimal('case_comission',20,2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
