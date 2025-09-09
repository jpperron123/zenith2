<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('assets', function (Blueprint $t)
		{
			$t->ulid('id')->primary();
			$t->string('name');               // benchpress1.png
			$t->string('path');               // storage path (ex: assets/benchpress1.png)
			$t->string('mime')->nullable();
			$t->unsignedInteger('width')->nullable();
			$t->unsignedInteger('height')->nullable();
			$t->string('checksum')->nullable(); // pour éviter les doublons si tu veux
			$t->timestamps();
		});
	}
	public function down(): void
	{
		Schema::dropIfExists('assets');
	}
};
