<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $course_id {@property-type relation} {@validation-rules required|integer|exists:App\Models\Course,id}
 * @property $theme {@property-type field} {@validation-rules required|string}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getMetadata {@statuses-access guest|logged}
 * @action getItem {@statuses-access logged} {@roles-access admin}
 * @action getItems {@statuses-access logged} {@roles-access admin}
 * @action create {@statuses-access logged} {@roles-access admin}
 * @action update {@statuses-access logged} {@roles-access admin}
 * @action delete {@statuses-access logged} {@roles-access admin}
 */
class Lesson extends EgalModel
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'theme',
    ];

    protected $guarder = [
        'created_at',
        'updated_at'
    ];


    public function lessonUsers(): HasMany
    {
        return $this->hasMany(LessonUser::class, 'lesson_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
