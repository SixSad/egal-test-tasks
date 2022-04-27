<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $title {@property-type field} {@validation-rules required|unique:courses|regex:/(^([a-z,0-9]+)?$)/ui}
 * @property $student_capacity {@property-type field} {@validation-rules required|integer|between:0,99}
 * @property $start_date {@property-type field} {@validation-rules required|date|after_or_equal:date}
 * @property $end_date {@property-type field} {@validation-rules required|date|after:start_date}
 * @property $has_certificate {@property-type field} {@validation-rules required|boolean}
 * @property Carbon $created_at    {@property-type field}
 * @property Carbon $updated_at    {@property-type field}
 *
 * @action getMetadata {@statuses-access logged} {@roles-access admin}
 * @action getItem {@statuses-access logged} {@roles-access admin}
 * @action getItems {@statuses-access logged} {@roles-access admin|user}
 * @action create {@statuses-access logged} {@roles-access admin}
 * @action update {@statuses-access logged} {@roles-access admin}{@permissions-access authenticate}
 * @action delete {@statuses-access logged} {@roles-access admin}{@permissions-access authenticate}
 */
class Course extends EgalModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'student_capacity',
        'start_date',
        'end_date',
        'has_certificate'
    ];

    protected $guarder = [
        'created_at',
        'updated_at'
    ];

    public function courseUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_users','course_id','user_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
}
