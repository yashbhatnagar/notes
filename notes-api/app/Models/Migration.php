<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Migration
 *
 * @property int $id
 * @property string $migration
 * @property int $batch
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Migration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Migration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Migration query()
 * @method static \Illuminate\Database\Eloquent\Builder|Migration whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Migration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Migration whereMigration($value)
 * @mixin \Eloquent
 */
class Migration extends Model
{
	protected $table = 'migrations';
	public $timestamps = false;

	protected $casts = [
		'batch' => 'int'
	];

	protected $fillable = [
		'migration',
		'batch'
	];
}
