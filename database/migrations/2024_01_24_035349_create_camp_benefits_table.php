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
        Schema::create('camp_benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_id')->constrained();
            $table->string('title');
            $table->timestamps();

            // 1st relationship method
            // $table->bigIncrement(camp_id); 
            // $table->unsignedBigInteger(camp_id);
 
            // 2nd relationship method 
            // $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_benefits');
    }
};
