<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentProperty extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'agent_properties';

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
