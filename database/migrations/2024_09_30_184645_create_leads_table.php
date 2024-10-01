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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->foreignId('vendor_id')->references('id')->on('users')->indexed()->nullable()->onDelete('no action');
            $table->tinyInteger('lead_type')->unsigned()->indexed();
            $table->date('dated');
            $table->string('first_name', 20);
            $table->string('last_name', 15);
            $table->string('mobile_number', 20)->nullable();
            $table->string('email')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
