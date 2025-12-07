<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Database\Factories\FloorPlanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan query()
 * @mixin \Eloquent
 */
class FloorPlan extends Model
{
    use HasFactory;

    protected $guarded = [];
}
