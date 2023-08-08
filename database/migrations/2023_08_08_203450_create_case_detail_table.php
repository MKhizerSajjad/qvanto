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
        Schema::create('case_detail', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('case_type_id')->unsigned()->indexed();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('case_detail');
    }
};
