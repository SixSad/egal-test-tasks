<?php

namespace App\DebugModels;

use App\Models\User;
use Illuminate\Support\Collection;

/**
 * @property $id            {@property-type field}  {@primary-key}
 * @property $email         {@property-type field}  {@validation-rules required|string|email|unique:users,email}
 * @property $password      {@property-type field}  {@validation-rules required|string}
 * @property $phone         {@property-type fake-field}
 * @property $first_name         {@property-type fake-field}
 * @property $last_name         {@property-type fake-field}
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
class UserDebug extends User{

}
