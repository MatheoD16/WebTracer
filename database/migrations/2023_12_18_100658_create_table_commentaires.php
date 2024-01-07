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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string("titre");
            $table->string("texte");
            $table->integer("id_utilisateur");
            $table->integer("id_scene");
            $table->foreign("id_utilisateur")->references("id")->on("users");
            $table->foreign("id_scene")->references("id")->on("scenes");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
