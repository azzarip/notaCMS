<?php

namespace Azzarip\NotaCMS\Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->text(),
        ];
    }
}
