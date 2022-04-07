<?php
/**
 * WSL2のShellからdockerのshellへログイン
 * docker container exec -it sample_laravel.test_1 bash
 * php artisan test tests/Feature/ScheduleTest.php
 * を実行する事
 */
namespace Tests\Feature;

use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\TransactionStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\Schedule;
use Database\Factories\ScheduleFactory;
use Database\Seeders\ScheduleSeeder;

class ScheduleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testDatabase()
    {
        $this->assertTrue(
            Schema::hasColumns('schedules', [
                'id', 'sch_date', 'sch_time', 'sch_category', 'sch_contents'
            ]),
            1
        );
    }

    /**
     * INSERT処理のテスト実装例
     * */
    public function testInsertData()
    {
        $schedule = new Schedule();
        $schedule->sch_date = '2022-04-01';
        $schedule->sch_time = '12:00:00';
        $schedule->sch_category = 'UnitTest';
        $schedule->sch_contents = 'UnitTest';
        $saveSchedule = $schedule->save();
        $this->assertTrue($saveSchedule);
        $this->assertDatabaseCount('schedules', 1);
    }

    /**
     * シーダを利用したテストの実装例
     * */
    public function testSeed()
    {
        // DatabaseSeederを実行
        $this->seed();

        // 配列中に指定してあるシーダを実行
        $this->seed([
            ScheduleSeeder::class,
        ]);

        $this->assertDatabaseCount('schedules', 3);
    }
}
