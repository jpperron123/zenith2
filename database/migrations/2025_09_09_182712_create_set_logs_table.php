<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('set_logs', function (Blueprint $t)
		{
			$t->ulid('id')->primary();
			$t->ulid('workout_id');
			$t->ulid('exercise_id');

			$t->unsignedSmallInteger('order_index')->default(1); // ordre dans la séance
			$t->unsignedSmallInteger('sets_count');              // ex: 3
			$t->unsignedSmallInteger('reps');                    // ex: 10
			$t->decimal('weight', 6, 2);
			$t->boolean('completed')->default(false);

			// exceptions optionnelles: [{ "set":2, "reps":8, "weight":95 }]
			$t->json('per_set_overrides')->nullable();

			$t->timestamps();

			$t->foreign('workout_id')->references('id')->on('workouts')->cascadeOnDelete();
			$t->foreign('exercise_id')->references('id')->on('exercises')->cascadeOnDelete();
			$t->index(['workout_id', 'order_index']);
		});
	}
	public function down(): void
	{
		Schema::dropIfExists('set_logs');
	}
};
