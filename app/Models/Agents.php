<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $profile_image
 * @property string|null $license_number
 * @property string|null $bio
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Agents active()
 * @method static \Illuminate\Database\Eloquent\Builder|Agents newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agents newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agents query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereProfileImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agents whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Agents extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
