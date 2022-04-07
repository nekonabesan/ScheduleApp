<?php

namespace Database\Seeders;

use App\Models\Schedule;
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
        // Seederでデータを投入する場合
        DB::table('schedules')->insert([
            'sch_date' => '2022-04-01',
            'sch_time' => '12:00:00',
            'sch_category' => Str::random(10),
            'sch_contents' => Str::random(10),
        ]);
        DB::table('schedules')->insert([
            'sch_date' => '2022-04-02',
            'sch_time' => '13:00:00',
            'sch_category' => Str::random(10),
            'sch_contents' => Str::random(10),
        ]);
        DB::table('schedules')->insert([
            'sch_date' => '2022-04-03',
            'sch_time' => '14:00:00',
            'sch_category' => Str::random(10),
            'sch_contents' => Str::random(10),
        ]);
        // factoryでデータを投入する場合
        //Schedule::factory()->count(3)->create();
    }
}
