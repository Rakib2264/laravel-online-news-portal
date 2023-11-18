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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('status')->nullable()->comment('1 = published 0 = not published');
            $table->tinyInteger('is_apporved')->nullable()->comment('1 = apporoved 0 = not apporoved');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('admin_comment')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
