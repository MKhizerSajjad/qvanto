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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->string('exam_id', 12)->unique();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->datetime('dated')->nullable();
            $table->boolean('is_accepted')->default(true);
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('counselor_id')->nullable();
            $table->foreign('counselor_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->tinyInteger('case_type_id')->unsigned()->indexed();
            $table->tinyInteger('language')->unsigned()->indexed()->nullable();
            $table->string('other_language')->nullable();

            $table->boolean('autism')->default(false);
            $table->boolean('intellectual_disability')->default(false);
            $table->string('authorization')->nullable();
            $table->string('disability')->nullable();
            $table->string('prior_diagnoses')->nullable();
            $table->string('medications')->nullable();
            $table->string('vocational_objective')->nullable();
            $table->string('payer')->default('Bureau of Vocational Rehabilitation');

            $table->string('emergency_name')->nullable();
            $table->string('emergency_mobile_number', 20)->nullable();

            $table->tinyInteger('family_relation')->unsigned()->nullable();
            $table->string('family_name')->nullable();
            $table->string('family_mobile_number', 20)->nullable();
            $table->string('family_email')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
