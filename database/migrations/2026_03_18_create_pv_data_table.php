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
        Schema::create('pv_data', function (Blueprint $table) {
            $table->id();
            $table->decimal('voltage', 8, 2)->comment('Tegangan dalam Volt (V)');
            $table->decimal('current', 8, 2)->comment('Arus dalam Ampere (A)');
            $table->decimal('temperature', 6, 2)->comment('Suhu dalam Celsius (°C)');
            $table->decimal('lux', 10, 2)->comment('Intensitas cahaya dalam Lux');
            $table->decimal('power_output', 10, 2)->nullable()->comment('Daya keluaran dalam Watt (W)');
            $table->decimal('voltage_change_percent', 7, 2)->default(0)->comment('Perubahan tegangan dalam persen (%)');
            $table->decimal('current_change_percent', 7, 2)->default(0)->comment('Perubahan arus dalam persen (%)');
            $table->decimal('lux_change_percent', 7, 2)->default(0)->comment('Perubahan lux dalam persen (%)');
            $table->decimal('temperature_change_percent', 7, 2)->default(0)->comment('Perubahan suhu dalam persen (%)');
            $table->timestamps();

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pv_data');
    }
};
