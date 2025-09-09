<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Asset extends Model
{
	use HasFactory, HasUlids;

	protected $fillable = ['name', 'path', 'mime', 'width', 'height', 'checksum'];

	// Relations
	public function exercises()
	{
		return $this->belongsToMany(Exercise::class, 'exercise_assets')
			->using(ExerciseAsset::class)
			->withPivot(['position', 'purpose'])
			->withTimestamps();
	}

	// Accessor pratique si tu seras sur Storage::disk()
	public function getUrlAttribute(): string
	{
		// adapte selon ton disk (public/s3)
		return Storage::url($this->path);
	}


	public function workouts()
	{
		return $this->hasMany(Workout::class);
	}
}
