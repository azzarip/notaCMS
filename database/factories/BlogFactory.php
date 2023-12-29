<?php

namespace Azzarip\NotaCMS\Database\Factories;

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
        ];
    }
}
