<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $title {@property-type field} {@validation-rules required|unique:courses|regex:/(^([a-z,0-9]+)?$)/ui}
 * @property $student_capacity {@property-type field} {@validation-rules required|integer|between:0,99}
 * @property $start_date {@property-type field} {@validation-rules required|date_format:Y-m-d|after_or_equal:date}
 * @property $end_date {@property-type field} {@validation-rules required|date_format:Y-m-d|after:start_date}
 * @property $has_certificate {@property-type field} {@validation-rules required|boolean}
 * @property Carbon $created_at    {@property-type field}
 * @property Carbon $updated_at    {@property-type field}
 *
 * @action getMetadata {@statuses-access logged} {@roles-access admin}
 * @action getItem {@statuses-access logged} {@roles-access admin}
 * @action getItems {@statuses-access logged} {@roles-access admin}
 * @action create {@statuses-access logged} {@roles-access admin}
 * @action update {@statuses-access logged} {@roles-access admin}{@permissions-access authenticate}
 * @action delete {@statuses-access logged} {@roles-access admin}{@permissions-access authenticate}
 */
class Course extends EgalModel
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'student_capacity',
        'start_date',
        'end_date',
        'has_certificate'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(CourseUser::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(LessonUser::class);
    }
}
