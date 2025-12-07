<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $property_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AgentProperty $agentproperty
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyGalleryImages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PropertyGalleryImages extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agentproperty()
    {
        return $this->belongsTo(AgentProperty::class, 'property_id', 'id');
    }
}
