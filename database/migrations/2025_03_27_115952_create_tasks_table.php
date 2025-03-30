<?php

use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plant::class);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('task_type', ['Arrosage', 'Fertilisation', 'Nettoyage', 'Taille', 'Transplantation', 'Engrais', 'Autre']);
            $table->timestamp('scheduled_at');
            $table->enum('status', ['A venir', 'Effectué', 'Annulé']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
