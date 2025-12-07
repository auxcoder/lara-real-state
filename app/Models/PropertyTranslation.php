<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $property_id
 * @property string $locale
 * @property string $title
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyTranslation whereTitle($value)
 * @mixin \Eloquent
 */
class PropertyTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
}
