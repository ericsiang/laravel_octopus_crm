<?php

use App\Account;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create(
            [ 
                'account' => 'admin',
                'password' => bcrypt('password'),
                'status'=>1,
            ]
        );
    }
}
