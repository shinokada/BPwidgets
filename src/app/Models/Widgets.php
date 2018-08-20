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
    protected $fillable = ['title', 'slug', 'order', 'position', 'content'];
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

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }
        return $this->title;
    }
}
