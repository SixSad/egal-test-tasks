<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $name {@property-type field} {@validation-rules required|string}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getMetadata {@statuses-access guest|logged}
 * @action getItem {@statuses-access guest|logged}
 * @action getItems {@statuses-access logged} {@roles-access super_first_role|super_second_role}
 * @action create {@statuses-access logged} {@roles-access super_first_role,super_second_role}
 * @action update {@statuses-access logged} {@permissions-access super_first_permission|super_second_permission}
 * @action delete {@statuses-access logged} {@permissions-access super_first_permission,super_second_permission}
 */
class CourseUser extends EgalModel
{
    protected $fillable = [
        'user_id',
        'course_id',
        'percentage_passing',
    ];

    public function singleCourse(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

}
