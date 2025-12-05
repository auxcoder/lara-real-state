<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

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
