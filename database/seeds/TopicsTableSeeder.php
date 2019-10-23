<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::all()->pluck('id')->toArray();
        $cagetoryIds = Category::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) use($faker,$userIds,$cagetoryIds) {
            $topic->user_id = $faker->randomElement($userIds);
            $topic->category_id = $faker->randomElement($cagetoryIds);
        });

        Topic::insert($topics->toArray());
    }

}

