<?php

namespace App\Models;


use App\Events\CreateCourseUserEvent;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $user_id {@property-type field}
 * @property $course_id {@property-type field}
 * @property $percentage_passing {@property-type field}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getMetadata {@statuses-access logged}{@roles-access admin}
 * @action getItem {@statuses-access logged}{@roles-access admin}
 * @action getItems {@statuses-access logged} {@roles-access admin}
 * @action create {@statuses-access logged} {@roles-access user}
 * @action delete {@statuses-access logged} {@roles-access user}
 */
class CourseUser extends EgalModel
{
    protected $fillable = [
        'user_id',
        'course_id',
        'percentage_passing',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $dispatchesEvents = [
        'creating' => CreateCourseUserEvent::class
    ];

    public function singleCourse(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

}
