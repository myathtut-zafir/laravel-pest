<?php

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('watched_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Video::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watched_videos');
    }
};
