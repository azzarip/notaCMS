<?php

namespace Azzarip\NotaCMS;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];
        
    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    public static function published() {
        return self::where('published_at', '<', now())
            ->paginate(config('blog.paginate'));
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUrlAttribute() 
    {
        return url(config('blog.path').'/'.$this->slug);
    }

    public static function open(string $slug): Blog 
    {
        return self::where('slug', $slug)->first();

    }

}
