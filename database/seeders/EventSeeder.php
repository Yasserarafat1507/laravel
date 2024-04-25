<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $eventCount = 20, int $tiketCount = 5): void
    {
        //if category emty run categorySeeder
        if(Category::count() == 0){
            $this->call(CategorySeeder::class);
        }

        // inser data using faker
        $faker = Factory::create();
        for($i = 0; $i < $eventCount; $i++){
        
        // Create event
        $event = Event::create([
            'name' => $faker->sentence(2),
            'slug' => $faker->slug(2),
            'headlind' => $faker->sentence(7),
            'description' => $faker->paragraph(1),
            'start_time' => $faker->dateTimeBetween('+1month', '+6month'),
            'location' => $faker->address(),
            'duration' => $faker->numberBetween(1,10),
            'catergory_id' => Category::inRandomOrder()->first()->id,
            'type' => $faker->randomElement(['onlain', 'offline']),
            'is_populer' => $faker->boolean(20)
        ]);

            // membuat tiket berdasarkan tiketCount
            for($j = 0; $j < $tiketCount; $j++) {
                $event->tickets()->create([
                    'name' => $faker->sentence(2),
                    'price' => $faker->numberBetween(10,100),
                    'quality' => $faker->numberBetween(10,100),
                    'max_buy' => $faker->numberBetween(1,10),
                ]);
            }
        }
    }
}
