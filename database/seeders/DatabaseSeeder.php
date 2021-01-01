<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // \App\Models\User::factory(3)->create();
        \App\Models\Genre::factory(4)->create();
        \App\Models\Book::factory(4)->create();
        \App\Models\Author::factory(3)->create();

        $authors = \App\Models\Author::all();

        \App\Models\Book::all()->each(function ($book) use ($authors) {
            $book->authors()->attach(
                $authors->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        foreach(['admin', 'moderator'] as $role_name) {
            $role = new \App\Models\Role();
            $role->name = $role_name;
            $role->save();
        }
    }
}
