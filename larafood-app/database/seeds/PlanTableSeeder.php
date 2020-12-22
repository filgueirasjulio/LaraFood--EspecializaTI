<?php

use App\Models\Plan;
use App\Models\DetailPlan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Plan::class, 30)->create()->each(function($p) {
            $p->details()->saveMany(factory(DetailPlan::class, 3)->make());
          });
    }
}
