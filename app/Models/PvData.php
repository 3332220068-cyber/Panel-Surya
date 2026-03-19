<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvData extends Model
{
    use HasFactory;

    protected $table = 'pv_data';

    protected $fillable = [
        'voltage',
        'current',
        'power_output',
        'temperature',
        'lux',
        'voltage_change_percent',
        'current_change_percent',
        'lux_change_percent',
        'temperature_change_percent',
    ];

    protected $casts = [
        'voltage' => 'float',
        'current' => 'float',
        'power_output' => 'float',
        'temperature' => 'float',
        'lux' => 'float',
        'voltage_change_percent' => 'float',
        'current_change_percent' => 'float',
        'lux_change_percent' => 'float',
        'temperature_change_percent' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the latest PV data record
     */
    public static function getLatest()
    {
        return self::latest()->first();
    }

    /**
     * Get data within a date range for charts
     */
    public static function getChartData($startDate = null, $endDate = null, $limit = 100)
    {
        $query = self::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->where('created_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        return $query->orderBy('created_at', 'asc')->limit($limit)->get();
    }
}
