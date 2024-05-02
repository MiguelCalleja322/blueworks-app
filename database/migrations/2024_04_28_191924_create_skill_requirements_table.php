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
        Schema::create('skill_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_sub_category_id');
            $table->foreign('skill_sub_category_id')->references('id')->on('skill_sub_categories')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_requirements');
    }
};
