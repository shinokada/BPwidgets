<?php
namespace shinokada\BPwidgets\app\Models;

use Backpack\CRUD\CrudTrait;
//use Config;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    use CrudTrait;
    use Sluggable;
    use SluggableScopeHelpers;
    protected $table = 'widgets';
    protected $fillable = ['value'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }
    /**
     * Grab a widget value from the database.
     *
     * @param string $key The widget key, as defined in the key db column
     *
     * @return string The widget value.
     */
    public static function get($key)
    {
        $widget = new self();
        $entry = $widget->where('key', $key)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }
    /**
     * Update a widget's value.
     *
     * @param string $key   The widget key, as defined in the key db column
     * @param string $value The new value.
     */
    public static function set($key, $value = null)
    {
        $prefixed_key = 'widgets.' . $key;
        $widget = new self();
        $entry = $widget->where('key', $key)->firstOrFail();
        // update the value in the database
        $entry->value = $value;
        $entry->saveOrFail();
        // update the value in the session
        Config::set($prefixed_key, $value);
        if (Config::get($prefixed_key) == $value) {
            return true;
        }
        return false;
    }

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }
        return $this->title;
    }
}
