<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)
            ->times(50)
            ->create()
            ->each(function (App\User $user) {
                $user->messages()->saveMany(factory(App\Message::class, 20)->make());
            });;
    }
}
