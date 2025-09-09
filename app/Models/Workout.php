<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
	use HasFactory, HasUlids;

	protected $fillable = ['user_id', 'date', 'title'];

	protected $casts = [
		'date' => 'date',
	];

	// Relations
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function setLogs()
	{
		return $this->hasMany(SetLog::class)->orderBy('order_index');
	}
}
