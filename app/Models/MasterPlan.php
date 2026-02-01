<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\MasterPlanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MasterPlan extends Model
{
    use HasFactory;

    protected $table = 'master_plans';

    protected $fillable = [
        'name',
        'image',
    ];
}
