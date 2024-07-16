<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('paddle_product_id');
            $table->string('slug');
            $table->string('tagline');
            $table->string('image_name');
            $table->json('learnings');
            $table->string('title');
            $table->text('description');
            $table->timestamp('release_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
