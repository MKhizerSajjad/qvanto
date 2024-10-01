<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {

            $data = [
                'user_type'      => 1,
                'first_name'   => 'Super',
                'last_name'    => 'Admin',
                'email'        => 'mkhizersajjad@gmail.com',
                'city_id'      => null,
                'state_id'     => null,
                'country_id'   => null,
                'password'     => bcrypt('12345678'),
            ];
            User::create($data);
        }
    }
}
