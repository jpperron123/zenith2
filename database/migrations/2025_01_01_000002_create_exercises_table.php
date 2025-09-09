<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('exercises', function (Blueprint $t)
		{
			$t->ulid('id')->primary();
			$t->string('name');
			$t->string('group');              // ex: Pectoraux
			$t->string('type');               // ex: polyarticulaire
			$t->timestamps();
		});
	}
	public function down(): void
	{
		Schema::dropIfExists('exercises');
	}
};
