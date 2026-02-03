<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Xvladqt\Faker\LoremFlickrProvider;

class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition(): array
    {
        $this->faker->addProvider(
            new \FakerRestaurant\Provider\fr_FR\Restaurant($this->faker)
        );

        $this->faker->addProvider(new LoremFlickrProvider($this->faker));

        $dir = public_path('images/faker');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $imageUrl = $this->faker->imageUrl(640, 480, ['food'], true);
        $imageContents = file_get_contents($imageUrl);
        $filename = $dir . '/' . time() . '_' . Str::random(8) . '.jpg';
        file_put_contents($filename, $imageContents);

        return [
            'title' => $this->faker->foodName(),
            'recipe' => $this->faker->realText(900),
            'image_path' => 'images/faker/' . basename($filename),
            'user_id' => User::factory(),
        ];
    }
}
