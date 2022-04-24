<?php

namespace App\Models;

use App\Events\UpdatedLessonUserEvent;
use App\Events\UpdatingLessonUserEvent;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $user_id {@property-type relation}
 * @property $lesson_id {@property-type relation} {@validation-rules required|integer|self_update}
 * @property $is_passed {@property-type field}{@validation-rules required|boolean}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action update {@roles-access user}
 */
class LessonUser extends EgalModel
{
    protected $fillable = [
        'user_id',
        'lesson_id',
        'is_passed',
    ];

    protected $guarder = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'user_id',
        'lesson_id',
    ];


    protected $dispatchesEvents = [
        'updating' => UpdatingLessonUserEvent::class,
        'updated' => UpdatedLessonUserEvent::class
    ];

    public function singleUser(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function singleLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
