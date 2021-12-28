<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * 
 * @property int $id
 * @property string $title
 * @property string|null $note
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Note extends Model
{
	protected $table = 'notes';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'title',
		'note',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
