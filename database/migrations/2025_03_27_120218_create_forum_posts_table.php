<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forum_posts', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->enum('category', ['Général', 'Maladies', 'Arrosage', 'Engrais', 'Exposition', 'Plantation', 'Taille', 'Autre']);
            $table->string('title');
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};
