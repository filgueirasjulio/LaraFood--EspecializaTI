<?php

use App\Models\Companie;
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
            $companie = Companie::first();

            $companie->users()->create(
        	[
		        'name' => 'Administrator',
		        'email' => 'admin@admin.com',
		        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        ]
        );
    }
}
