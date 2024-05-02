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
        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('skill_sub_category_id');
            $table->foreign('skill_sub_category_id ')->references('id')->on('skill_sub_categories')->onDelete('cascade');
            $table->unsignedBigInteger('skill_requirement_id');
            $table->foreign('skill_requirement_id ')->references('id')->on('skill_requirements')->onDelete('cascade');
            $table->boolean('is_allowed')->default(0);
            $table->boolean('is_submitted')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_skills');
    }
};
