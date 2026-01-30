<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Database\Factories\MasterPlanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterPlan query()
 * @mixin \Eloquent
 */
class MasterPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];
}
