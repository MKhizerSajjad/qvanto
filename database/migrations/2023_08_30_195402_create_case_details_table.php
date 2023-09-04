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
        Schema::create('case_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('case_type_id')->unsigned()->indexed();
            $table->tinyInteger('question_id')->unsigned()->indexed();
            $table->longText('detail')->nullable();
            $table->longText('note')->nullable();
            // $table->unsignedBigInteger('case_id');
            // $table->foreign('case_id')->references('id')->on('cases')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_details');
    }
};
