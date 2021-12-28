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
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUserId($value)
 * @mixin \Eloquent
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
