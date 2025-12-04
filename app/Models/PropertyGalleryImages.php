<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGalleryImages extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agentproperty()
    {
        return $this->belongsTo(AgentProperty::class, 'property_id', 'id');
    }
}
