<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Collection;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create()->each(function ($user) {
            $user->collection()->saveMany(factory(Collection::class, 9)->make());
        });
    }
}
