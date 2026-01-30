<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $agent_id
 * @property string|null $slug
 * @property string|null $location
 * @property string|null $property_type
 * @property string|null $transaction_type
 * @property string|null $price
 * @property string|null $area
 * @property int|null $bedrooms
 * @property int|null $bathrooms
 * @property string|null $main_image
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Agents|null $agent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PropertyGalleryImages> $propertygallery
 * @property-read int|null $propertygallery_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PropertyTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty wherePropertyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProperty withoutTrashed()
 * @mixin \Eloquent
 */
class AgentProperty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agent_id',
        'slug',
        'location',
        'property_type',
        'transaction_type',
        'price',
        'area',
        'bedrooms',
        'bathrooms',
        'main_image',
        'status',
    ];

    protected $table = 'agent_properties';

    public function agent()
    {
        return $this->belongsTo(Agents::class, 'agent_id');
    }

    public function propertygallery()
    {
        return $this->hasMany(PropertyGalleryImages::class, 'property_id', 'id');
    }

    public function translations()
    {
        return $this->hasMany(PropertyTranslation::class, 'property_id');
    }

    public function translate($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $this->translations->where('locale', $locale)->first();
    }

    public function translated($field)
    {
        $locale = app()->getLocale(); // Or session('locale')

        return optional($this->translations->where('locale', $locale)->first())->$field ?? '';
    }
}
