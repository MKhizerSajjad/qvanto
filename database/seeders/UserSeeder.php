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
                'email'        => 'admin@admin.com',
                'city_id'      => 1,
                'state_id'     => 2,
                'country_id'   => 3,
                'password'     => bcrypt('password'),
            ];
            User::create($data);
        }
    }
}
