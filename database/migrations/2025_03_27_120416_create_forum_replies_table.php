<?php

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forum_replies', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ForumPost::class);
            $table->foreignIdFor(User::class);
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_replies');
    }
};
