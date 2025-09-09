<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExerciseAsset extends Pivot
{
	protected $table = 'exercise_assets';

	protected $fillable = [
		'exercise_id',
		'asset_id',
		'position',
		'purpose',
	];

	public $timestamps = true;

	protected $casts = [
		'position' => 'integer',
	];
}
