<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get blog posts using this tag.
     *
     * @return App\Post
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    /**
     * Get the permanent URL for querying posts by this tag.
     *
     * @return string
     */
    public function getPermalinkAttribute()
    {
        return action('BlogController@byTag', $this->slug);
    }

    /**
     * Get the URL of the tag banner image.
     *
     * @return string
     */
    public function getBannerUrlAttribute() {
        $baseUrl = config('filesystems.disks.storage.url').'/banners/tags';

        if (!\Storage::disk('storage')->exists('banners/tags/'.$this->banner.'.jpg'))
            return $baseUrl.'/default.jpg';
        
        return $baseUrl.'/'.$this->banner.'.jpg';
    }
}
