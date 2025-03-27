<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plants', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->string('image')->nullable();
            $table->enum('type', ['Fleur', 'Plante verte', 'Cactus', 'Plante grasse', 'Arbre', 'Arbuste', 'Plante aquatique', 'Plante grimpante', 'Plante d\'intérieur', 'Plante d\'extérieur', 'Autre']);
            $table->integer('watering_frequency');
            $table->enum('sun_exposure', ['Plein soleil', 'Mi-ombre', 'Ombre']);
            $table->enum('soil_type', ['Argileux', 'Sableux', 'Limoneux', 'Humifère', 'Calcaire', 'Tourbe', 'Autre']);
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
