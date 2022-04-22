<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $title {@property-type field} {@validation-rules required|string}
 * @property $student_capacity {@property-type field} {@validation-rules required|string}
 * @property $start_date {@property-type field} {@validation-rules required|string}
 * @property $end_date {@property-type field} {@validation-rules required|string}
 * @property $has_certificate {@property-type field} {@validation-rules required|string}
 * @property Carbon $created_at    {@property-type field}
 * @property Carbon $updated_at    {@property-type field}
 *
 * @action getMetadata {@statuses-access logged}
 * @action getItem {@statuses-access logged}
 * @action getItems {@statuses-access guest} {@roles-access super_first_role|super_second_role}
 * @action create {@statuses-access guest} {@roles-access super_first_role,super_second_role}
 * @action update {@statuses-access guest} {@permissions-access super_first_permission|super_second_permission}
 * @action delete {@statuses-access guest} {@permissions-access super_first_permission,super_second_permission}
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
