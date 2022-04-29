<?php

namespace App\Models;

use App\Events\CreateUserEvent;
use App\Exceptions\EmptyPasswordException;
use Carbon\Carbon;
use Egal\Auth\Tokens\UserMasterRefreshToken;
use Egal\Auth\Tokens\UserMasterToken;
use Egal\AuthServiceDependencies\{
    Exceptions\LoginException,
    Models\User as BaseUser
};
use Illuminate\Database\Eloquent\{
    Casts\Attribute,
    Factories\HasFactory,
    Relations\BelongsToMany
};
use Illuminate\Support\Collection;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * @property $id            {@property-type field}  {@primary-key}
 * @property $email         {@property-type field}  {@validation-rules required|string|email|unique:users,email}
 * @property $password      {@property-type field}  {@validation-rules required|string}
 * @property $phone         {@property-type fake-field}
 * @property $first_name    {@property-type fake-field}
 * @property $last_name     {@property-type fake-field}
 * @property $in_session    {@property-type field}
 * @property $created_at    {@property-type field}
 * @property $updated_at    {@property-type field}
 *
 * @property Collection $roles          {@property-type relation}
 * @property Collection $permissions    {@property-type relation}
 *
 * @action register                     {@statuses-access guest}
 * @action login                        {@statuses-access guest}
 * @action loginToService               {@statuses-access guest}
 * @action refreshUserMasterToken       {@statuses-access guest}
 * @action getItems {@statuses-access guest} {@roles-access super_first_role|super_second_role}
 */
class User extends BaseUser
{
    use HasFactory;
    use HasRelationships;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'phone',
        'last_name',
        'first_name'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'in_session' => 'array',
    ];

    protected $dispatchesEvents = [
        'creating' => CreateUserEvent::class,
    ];

    protected function password(): Attribute
    {
        return new Attribute(
            set: fn($value) => password_hash($value, PASSWORD_BCRYPT),
        );
    }

    public static function actionRegister(array $attributes = []): User
    {
        if (!$attributes['password']) {
            throw new EmptyPasswordException();
        }

        $user = new static();
        $user->setAttribute('email', $attributes['email']);
        $user->setAttribute('password', $attributes['password']);
        $user->save();

        return $user;
    }

    public static function actionLogin(string $email, string $password): array
    {
        /** @var BaseUser $user */
        $user = self::query()
            ->where('email', '=', $email)
            ->first();

        if (!$user || !password_verify($password, $user->getAttribute('password'))) {
            throw new LoginException('Incorrect Email or password!');
        }

        $umt = new UserMasterToken();
        $umt->setSigningKey(config('app.service_key'));
        $umt->setAuthIdentification($user->getAuthIdentifier());

        $umrt = new UserMasterRefreshToken();
        $umrt->setSigningKey(config('app.service_key'));
        $umrt->setAuthIdentification($user->getAuthIdentifier());
        $user->setAttribute('in_session', Carbon::now()->toDateTimeString());
        $user->save();

        return [
            'user_master_token' => $umt->generateJWT(),
            'user_master_refresh_token' => $umrt->generateJWT()
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function permissions(): HasManyDeep
    {
        return $this->hasManyDeep(
            Permission::class,
            [UserRole::class, Role::class, RolePermission::class],
            ['user_id', 'id', 'role_id', 'id'],
            ['id', 'role_id', 'id', 'permission_id']
        );
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function (User $user) {
            $defaultRoles = Role::query()
                ->where('is_default', true)
                ->get();
            $user->roles()
                ->attach($defaultRoles->pluck('id'));
        });
    }

    protected function getRoles(): array
    {
        return array_unique($this->roles->pluck('id')->toArray());
    }

    protected function getPermissions(): array
    {
        return array_unique($this->permissions->pluck('id')->toArray());
    }

}
