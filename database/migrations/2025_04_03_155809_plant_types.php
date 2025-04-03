<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE plants DROP CONSTRAINT IF EXISTS plants_type_check');
        Schema::table('plants', static function (Blueprint $table) {
            $table->string('type')->change();
        });
    }

    public function down(): void
    {
        Schema::table('plants', static function (Blueprint $table) {
            $table->enum('type', ['Fleur', 'Plante verte', 'Cactus', 'Plante grasse', 'Arbre', 'Arbuste', 'Plante aquatique', 'Plante grimpante', 'Autre'])->change();
        });
    }
};

