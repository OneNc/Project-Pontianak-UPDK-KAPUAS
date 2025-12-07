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
        Schema::create('instantaneous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_meter')->constrained('meters')->onDelete('cascade');
            $table->float('voltage_r')->nullable();
            $table->float('voltage_s')->nullable();
            $table->float('voltage_t')->nullable();
            $table->float('current_r')->nullable();
            $table->float('current_s')->nullable();
            $table->float('current_t')->nullable();
            $table->float('cosphi')->nullable();
            $table->float('frequency')->nullable();
            $table->float('battery')->nullable();
            $table->float('power_active_import')->nullable();
            $table->float('power_reactive_import')->nullable();
            $table->float('power_apparent_import')->nullable();
            $table->float('power_active_export')->nullable();
            $table->float('power_reactive_export')->nullable();
            $table->float('power_apparent_export')->nullable();
            $table->float('export_energy_rate1')->nullable();
            $table->float('export_energy_rate2')->nullable();
            $table->float('export_energy_total')->nullable();
            $table->float('import_energy_rate1')->nullable();
            $table->float('import_energy_rate2')->nullable();
            $table->float('import_energy_total')->nullable();
            $table->float('kvar_energy_export')->nullable();
            $table->float('kvar_energy_import')->nullable();
            $table->float('phasor_vr')->nullable();
            $table->float('phasor_ir')->nullable();
            $table->float('phasor_vs')->nullable();
            $table->float('phasor_is')->nullable();
            $table->float('phasor_vt')->nullable();
            $table->float('phasor_it')->nullable();
            $table->enum('status', ['scheduler', 'realtime'])->default('realtime');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instantaneouses');
    }
};
