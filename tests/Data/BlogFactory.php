<?php

namespace Azzarip\NotaCMS\Tests\Data;

use Azzarip\NotaCMS\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->text(50),
            'slug' => fake()->slug(4),
            'published_at' => fake()->dateTimeInInterval('-1 week', '+1 day'),
        ];
    }
}
