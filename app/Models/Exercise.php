<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
	use HasFactory, HasUlids;

	protected $fillable = ['name', 'group', 'type'];

	// Relations
	public function setLogs()
	{
		return $this->hasMany(SetLog::class);
	}

	public function assets()
	{
		return $this->belongsToMany(Asset::class, 'exercise_assets')
			->using(ExerciseAsset::class)
			->withPivot(['position', 'purpose'])
			->withTimestamps()
			->orderBy('position');
	}
}
