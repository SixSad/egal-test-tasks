<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property uuid $id {@property-type field} {@prymary-key}
 * @property string $phone {@property-type field} {@validation-rules required|string}
 * @property string $last_name {@property-type field} {@validation-rules required|string}
 * @property string $first_name {@property-type field} {@validation-rules required|string}
 * @property Carbon $created_at {@property-type field}
 * @property Carbon $updated_at {@property-type field}
 *
 * @action getMetadata {@statuses-access guest|logged}
 * @action getItem {@statuses-access guest|logged}
 * @action getItems {@statuses-access guest|logged} {@roles-access super_first_role|super_second_role}
 * @action create {@statuses-access guest|logged} {@roles-access super_first_role,super_second_role} {@services-access auth}
 * @action update {@statuses-access guest|logged} {@permissions-access super_first_permission|super_second_permission}
 * @action delete {@statuses-access guest|logged} {@permissions-access super_first_permission,super_second_permission}
 */
class User extends EgalModel
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'phone',
        'last_name',
        'first_name',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_users', 'user_id', 'course_id');
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_users', 'user_id', 'lesson_id');
    }

}
