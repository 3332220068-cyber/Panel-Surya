<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('pv_data', 'intensity') || Schema::hasColumn('pv_data', 'intensity_change_percent')) {
            Schema::table('pv_data', function (Blueprint $table) {
                if (Schema::hasColumn('pv_data', 'intensity')) {
                    $table->dropColumn('intensity');
                }

                if (Schema::hasColumn('pv_data', 'intensity_change_percent')) {
                    $table->dropColumn('intensity_change_percent');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pv_data', function (Blueprint $table) {
            if (!Schema::hasColumn('pv_data', 'intensity')) {
                $table->decimal('intensity', 10, 2)->nullable()->after('temperature');
            }

            if (!Schema::hasColumn('pv_data', 'intensity_change_percent')) {
                $table->decimal('intensity_change_percent', 7, 2)->default(0)->after('current_change_percent');
            }
        });
    }
};
