<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('workouts', function (Blueprint $t)
		{
			$t->ulid('id')->primary();
			$t->foreignId('user_id')->constrained()->cascadeOnDelete();
			$t->date('date');
			$t->string('title')->nullable();
			$t->timestamps();
			$t->unique(['user_id', 'date']);
		});
	}
	public function down(): void
	{
		Schema::dropIfExists('workouts');
	}
};
