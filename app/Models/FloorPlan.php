<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $developer_property_id
 * @property string|null $category
 * @property string|null $unit_type
 * @property string|null $floor_details
 * @property string|null $sizes
 * @property string|null $type
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\FloorPlanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereDeveloperPropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereFloorDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereSizes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FloorPlan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FloorPlan extends Model
{
    use HasFactory;

    protected $table = 'floor_plans';

    protected $fillable = [
        'developer_property_id',
        'category',
        'unit_type',
        'floor_details',
        'sizes',
        'type',
        'image',
    ];
}
