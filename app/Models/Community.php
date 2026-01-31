<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $feature_description
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Amenity> $amenities
 * @property-read int|null $amenities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Community newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Community newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Community onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Community query()
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereFeatureDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Community withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Community withoutTrashed()
 * @mixin \Eloquent
 */
class Community extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'feature_description',
        'image',
    ];

    protected $table = 'communities';

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_community', 'community_id', 'amenity_id');
    }
}
