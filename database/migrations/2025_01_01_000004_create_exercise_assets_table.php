<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('exercise_assets', function (Blueprint $t)
		{
			$t->id();
			$t->ulid('exercise_id');
			$t->ulid('asset_id');
			$t->unsignedSmallInteger('position')->default(1); // ordre d’affichage
			$t->enum('purpose', ['thumbnail', 'step', 'animation'])->default('thumbnail');
			$t->timestamps();

			$t->foreign('exercise_id')->references('id')->on('exercises')->cascadeOnDelete();
			$t->foreign('asset_id')->references('id')->on('assets')->cascadeOnDelete();
			$t->unique(['exercise_id', 'asset_id']);               // pas de doublon
			$t->index(['exercise_id', 'position']);                // tri rapide
		});
	}
	public function down(): void
	{
		Schema::dropIfExists('exercise_assets');
	}
};
