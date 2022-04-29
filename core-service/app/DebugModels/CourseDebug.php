<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * @property int $id {@property-type field} {@prymary-key}
 * @property string $title {@property-type field} {@validation-rules required|string|unique:courses|regex:/(^([a-z,0-9]+)?$)/ui}
 * @property int $student_capacity {@property-type field} {@validation-rules required|integer|between:0,99}
 * @property $start_date {@property-type field} {@validation-rules required|date|after_or_equal:date}
 * @property $end_date {@property-type field} {@validation-rules required|date|after:start_date}
 * @property bool $has_certificate {@property-type field} {@validation-rules required|boolean}
 * @property Carbon $created_at    {@property-type field}
 * @property Carbon $updated_at    {@property-type field}
 *
 * @action getMetadata {@statuses-access logged} {@roles-access admin}
 * @action getItem {@statuses-access logged} {@roles-access admin}
 * @action getItems {@statuses-access logged} {@roles-access admin|user}
 * @action create {@statuses-access logged} {@roles-access admin}
 * @action update {@statuses-access logged} {@roles-access admin}{@permissions-access authenticate}
 * @action delete {@statuses-access logged} {@roles-access admin}{@permissions-access authenticate}
 */
class CourseDebug extends Course
{

}
