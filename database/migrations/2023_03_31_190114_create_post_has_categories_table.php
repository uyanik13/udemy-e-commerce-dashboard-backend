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
        Schema::create('post_has_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_category_id');
            $table->foreignId('post_id');
            $table->timestamps();
            $table->foreign('post_category_id')
                ->references('id')
                ->on('post_categories')
                ->onDelete('cascade');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_has_categories');
    }
};
