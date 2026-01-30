<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string|null $slug
 * @property int $developer_id
 * @property string $name
 * @property string $location
 * @property string $status
 * @property int|null $bedrooms
 * @property int|null $bathrooms
 * @property string|null $price
 * @property string|null $description
 * @property string|null $key_highlights
 * @property array|null $paymentPlan
 * @property string|null $handover_date
 * @property string|null $handover_percentage
 * @property string|null $down_percentage
 * @property string|null $construction_percentage
 * @property string|null $logo
 * @property string|null $cover_image
 * @property \App\Models\Community|null $community
 * @property string|null $masterPlan_image
 * @property string|null $locationMap
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $masterPlan_description
 * @property string|null $floorPlan_description
 * @property string|null $locationMap_description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Amenity> $amenity
 * @property-read int|null $amenity_count
 * @property-read \App\Models\Developer|null $developer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FloorPlan> $floorPlans
 * @property-read int|null $floor_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Images> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MasterPlan> $masterPlans
 * @property-read int|null $master_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PropertyType> $propertyTypes
 * @property-read int|null $property_types_count
 * @method static \Database\Factories\DeveloperPropertyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereCommunity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereConstructionPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereDownPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereFloorPlanDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereHandoverDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereHandoverPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereKeyHighlights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereLocationMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereLocationMapDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereMasterPlanDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereMasterPlanImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty wherePaymentPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeveloperProperty withoutTrashed()
 * @mixin \Eloquent
 */
class DeveloperProperty extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'paymentPlan' => 'array',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community');
    }

    public function amenity()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_developer_property', 'developer_property_id', 'amenity_id');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'developer_property_location')
            ->withPivot('distance');
    }

    public function masterPlans()
    {
        return $this->belongsToMany(MasterPlan::class, 'developer_property_masterPlan');
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function propertyTypes()
    {
        return $this->hasMany(PropertyType::class);
    }

    public function floorPlans()
    {
        return $this->hasMany(FloorPlan::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }
}
