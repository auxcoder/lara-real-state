<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $position
 * @property string $description
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $linkedin
 * @property string|null $instagram
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image
 * @property string|null $experience
 * @property string|null $languages
 * @property string|null $NID
 * @property string|null $descripton
 * @property string $specialties
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereDescripton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereSpecialties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TeamMember extends Model
{
    use HasFactory;

    protected $guarded = [];
}
