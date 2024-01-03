<?php

namespace Azzarip\NotaCMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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

    protected string $path;



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

    public static function loadFile(string $path): ?Blog
    {
        if (! file_exists($path)) {
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
        return base_path('content/notacms/') . $this->getPath() . '/' . $this->slug .'.md';
    }

    public function getPath() {
        return $this->path ?? \lcfirst(class_basename($this));
    }

    public function getBodyAttribute()
    {
        return YamlFrontMatter::parseFile($this->getFilePath())->body();
    }

    public function getUrlAttribute()
    {
        return url($this->getPath().'/'.$this->slug);
    }

}
