<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $schDates = ['2022-04-01', '2022-04-02', '2022-04-03'];
        $schTimes = ['12:00:00', '13:00:00', '14:00:00'];
        $schCategorys = ['カテゴリー1', 'カテゴリー2', 'カテゴリー3'];
        $schContents = ['コンテンツ1', 'コンテンツ2', 'コンテンツ3'];

        $sch_date = $schDates[count($schDates) - 1];
        $sch_time = $schTimes[count($schTimes) - 1];
        $sch_category = $schCategorys[count($schCategorys) - 1];
        $sch_contents = $schContents[count($schContents) - 1];

        return [
            'sch_date' => $sch_date,
            'sch_time' => $sch_time,
            'sch_category' => $sch_category,
            'sch_contents' => $sch_contents,
        ];
    }
}
