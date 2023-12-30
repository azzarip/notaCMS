<?php

namespace Azzarip\NotaCMS;

use Illuminate\Database\Eloquent\Model;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Blog extends Model
{
    protected $guarded = [];

    protected $table = 'blog';

    protected $perPage = 7;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function published()
    {
        return self::where('published_at', '<', now())
            ->orderBy('published_at', 'desc')
            ->paginate();
    }

    public function getUrlAttribute()
    {
        return url(config('notacms.blog.path').'/'.$this->slug);
    }

    public static function open(string $slug): Blog
    {
        return self::where('slug', $slug)->first();

    }

    public static function loadFile(string $path): ?Blog
    {
        if (! file_exists($path)) {
            return null;
        }

        $file = YamlFrontMatter::parseFile($path);

        return Blog::updateOrCreate([
            'slug' => pathinfo($path)['filename'],
        ], [
            'title' => $file->title,
            'description' => $file->description,
            'published_at' => \Carbon\Carbon::parse($file->published_at),
        ]);
    }
}
