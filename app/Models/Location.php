<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function developerProperties()
    {
        return $this->belongsToMany(DeveloperProperty::class, 'developer_property_location')
            ->withPivot('distance');
    }
}
