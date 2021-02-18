<?php

use App\Models\Company;
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
            $company = Company::first();

            $company->users()->create(
        	[
		        'name' => 'Administrator',
		        'email' => 'admin@admin.com',
		        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        ]
        );
    }
}
