<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('schedules')->insert([
            'sch_date' => '2022-04-02',
            'sch_time' => '12:00:00',
            'sch_category' => Str::random(10),
            'sch_contents' => Str::random(10),
        ]);
    }
}
