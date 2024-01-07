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
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("equipe");
            $table->string("description");
            $table->dateTime("date_ajout");
            $table->string("scene");
            $table->string("lien_image");
            $table->string("lien_vignette");
            $table->string("lien_executable");
            $table->integer("id_utilisateur");
            $table->foreign("id_utilisateur")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenes');
    }
};
