<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('pv_data') && !Schema::hasColumn('pv_data', 'lux_change_percent')) {
            Schema::table('pv_data', function (Blueprint $table) {
                $table->decimal('lux_change_percent', 7, 2)
                    ->default(0)
                    ->after('current_change_percent')
                    ->comment('Perubahan lux dalam persen (%)');
            });

            if (Schema::hasColumn('pv_data', 'intensity_change_percent')) {
                DB::table('pv_data')->update([
                    'lux_change_percent' => DB::raw('intensity_change_percent'),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('pv_data', 'lux_change_percent')) {
            Schema::table('pv_data', function (Blueprint $table) {
                $table->dropColumn('lux_change_percent');
            });
        }
    }
};
