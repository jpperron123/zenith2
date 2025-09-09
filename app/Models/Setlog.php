<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class SetLog extends Model
{
	use HasFactory, HasUlids;

	protected $table = 'set_logs';

	protected $fillable = [
		'workout_id',
		'exercise_id',
		'order_index',
		'sets_count',
		'reps',
		'weight',
		'completed',
		'per_set_overrides',
	];

	protected $casts = [
		'completed' => 'bool',
		'per_set_overrides' => 'array',
		'weight' => 'decimal:2',
	];

	// Relations
	public function workout()
	{
		return $this->belongsTo(Workout::class);
	}

	public function exercise()
	{
		return $this->belongsTo(Exercise::class);
	}
}
