<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Config
 *
 * @property string $key
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Config whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Config whereValue($value)
 */
	class Config extends \Eloquent {}
}

namespace App{
/**
 * App\Group
 *
 * @property int $id
 * @property string $group_id
 * @property string|null $last_post_updated
 * @property string|null $last_updated
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereLastPostUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereLastUpdated($value)
 */
	class Group extends \Eloquent {}
}

namespace App{
/**
 * App\Post
 *
 * @property int $id
 * @property string $post_id
 * @property string $message
 * @property string|null $story
 * @property string $updated_time
 * @property int $group_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereStory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedTime($value)
 */
	class Post extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

