<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $phone {@property-type field} {@validation-rules required|string}
 * @property $last_name {@property-type field} {@validation-rules required|string}
 * @property $first_name {@property-type field} {@validation-rules required|string}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getMetadata {@statuses-access guest|logged}
 * @action getItem {@statuses-access guest|logged}
 * @action hi {@statuses-access guest|logged}
 * @action getItems {@statuses-access guest|logged} {@roles-access super_first_role|super_second_role}
 * @action create {@statuses-access guest|logged} {@roles-access super_first_role,super_second_role} {@services-access auth}
 * @action update {@statuses-access guest|logged} {@permissions-access super_first_permission|super_second_permission}
 * @action delete {@statuses-access guest|logged} {@permissions-access super_first_permission,super_second_permission}
 */
class User extends EgalModel
{
    protected $fillable = [
        'id',
        'phone',
        'last_name',
        'first_name',
    ];

    protected $guarder = [
        'created_at',
        'updated_at'
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
