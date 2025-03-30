<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chatgpt_messages', static function (Blueprint $table) {
            $table->id();
            $table->string('chatgpt_id');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('run_id')->nullable();
            $table->string('role');
            $table->text('content');
            $table->string('type');
            $table->string('object');
            $table->text('attachments');
            $table->text('metadata');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatgpt_messages');
    }
};
