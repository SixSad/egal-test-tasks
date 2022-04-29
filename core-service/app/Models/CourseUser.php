<?php

namespace App\Models;

use App\Events\CourseUserCreatedEvent;
use App\Events\CourseUserCreatingEvent;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $user_id {@property-type field} {@validation-rules required|uuid|exists:users,id}
 * @property $course_id {@property-type field} {@validation-rules required|integer|exists:courses,id|unique_course_user}
 * @property $percentage_passing {@property-type field} {@validation-rules integer}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action create {@statuses-access logged} {@roles-access user}
 */
class CourseUser extends EgalModel
{
    protected $fillable = [
        'user_id',
        'course_id',
        'percentage_passing',
    ];

    protected $dispatchesEvents = [
        'creating' => CourseUserCreatingEvent::class,
        'created' => CourseUserCreatedEvent::class
    ];
}
