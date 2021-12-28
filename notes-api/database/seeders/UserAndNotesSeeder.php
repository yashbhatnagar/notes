<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserAndNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $user = User::updateOrCreate(
            ['email' => 'john@doe.com'],
            [
                'name' => 'John Doe',
                'email' => 'john@doe.com',
                'password' => bcrypt('1234')
            ]
        );

        User::updateOrCreate(
            ['email' => 'john@doe2.com'],
            [
                'name' => 'John Doe 2',
                'email' => 'john@doe2.com',
                'password' => bcrypt('1234')
            ]
        );

        for ($i = 0; $i < 5; $i++) {

            Note::updateOrCreate(
                ['title' => "Note ${i}"],
                [
                    'note' => $faker->sentence(),
                    'user_id' => $user->getKey()
                ]
            );
        }
    }
}
