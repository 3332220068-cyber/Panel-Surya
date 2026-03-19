<?php

namespace Database\Seeders;

use App\Models\PvData;
use Illuminate\Database\Seeder;

class PvDataSeeder extends Seeder
{
    /**
     * Seed initial demo PV data for dashboard visualization.
     */
    public function run(): void
    {
        if (PvData::count() > 0) {
            return;
        }

        $startTime = now()->subHours(2);

        for ($i = 0; $i < 120; $i++) {
            $voltage = 215 + sin($i / 7) * 6 + mt_rand(-10, 10) / 10;
            $current = 4.8 + sin($i / 9) * 0.9 + mt_rand(-6, 6) / 10;
            $temperature = 31 + sin($i / 20) * 3 + mt_rand(-6, 6) / 10;
            $lux = 760 + sin($i / 8) * 150 + mt_rand(-30, 30);

            PvData::create([
                'voltage' => round($voltage, 2),
                'current' => round($current, 2),
                'temperature' => round($temperature, 2),
                'lux' => round($lux, 2),
                'power_output' => round($voltage * $current, 2),
                'voltage_change_percent' => mt_rand(-25, 25) / 10,
                'current_change_percent' => mt_rand(-30, 30) / 10,
                'lux_change_percent' => mt_rand(-35, 35) / 10,
                'temperature_change_percent' => mt_rand(-10, 10) / 10,
                'created_at' => $startTime->copy()->addMinutes($i),
                'updated_at' => $startTime->copy()->addMinutes($i),
            ]);
        }
    }
}
