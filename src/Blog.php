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
}
