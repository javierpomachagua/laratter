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
        $users = factory(App\User::class)
            ->times(50)
            ->create();
        
        $users->each(function (App\User $user) use ($users) {
                $user->messages()->saveMany(factory(App\Message::class, 20)->make());
            
                $user->follows()->sync(
                    $users->random(10)
                );

            });;
    }
}
