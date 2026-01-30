<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Community> $communities
 * @property-read int|null $communities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeveloperProperty> $developerProperties
 * @property-read int|null $developer_properties_count
 * @method static \Database\Factories\AmenityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity withoutTrashed()
 * @mixin \Eloquent
 */
class Amenity extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function developerProperties()
    {
        return $this->belongsToMany(DeveloperProperty::class, 'amenity_developer_property');
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'amenity_community');
    }
}
