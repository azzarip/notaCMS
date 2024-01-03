<?php

namespace Azzarip\NotaCMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Blog extends Model
{
    use HasSEO;

    protected $guarded = [];

    protected $perPage = 7;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected string $route;

    public static function published()
    {
        return self::where('published_at', '<', now())
            ->orderBy('published_at', 'desc')
            ->paginate();
    }

    public static function findSlug(string $slug): ?Blog
    {
        return self::where('slug', $slug)->first();

    }

    public static function loadFile(string $fileName): ?Blog
    {
        $path = self::getPath().$fileName.'.md';
        if (! File::exists($path)) {
            return null;
        }

        $file = YamlFrontMatter::parseFile($path);
        $fields = $file->matter();
        $metaFields = Arr::where($fields,
            fn ($v, $key) => Str::startsWith($key, 'meta_')
        );

        $fields = Arr::except($fields, array_keys($metaFields));

        $post = self::updateOrCreate([
            'slug' => pathinfo($path)['filename'],
        ], $fields);

        $metaKeys = Arr::map(array_keys($metaFields), fn ($value, $key) => Str::after($value, 'meta_'));

        $metaFields = array_combine($metaKeys, array_values($metaFields));
        $post->seo->update($metaFields);

        return $post;
    }

    private function getFilePath(): string
    {
        return $this->getPath().$this->slug.'.md';
    }

    public static function getPath(): string
    {
        return base_path('content/notacms/').self::getRoute().'/';
    }

    public static function getRoute()
    {
        return \lcfirst(class_basename(static::class));
    }

    public function getBodyAttribute()
    {
        return YamlFrontMatter::parseFile($this->getFilePath())->body();
    }

    public function getUrlAttribute()
    {
        return url($this->getRoute().'/'.$this->slug);
    }
}
