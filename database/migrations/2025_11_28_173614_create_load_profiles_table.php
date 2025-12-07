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
        Schema::create('load_profiles', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('id_meter')->constrained('meters')->onDelete('cascade');
            $table->integer("record");
            $table->float('import_wh')->nullable();
            $table->float('export_wh')->nullable();
            $table->float('import_varh')->nullable();
            $table->float('export_varh')->nullable();
            $table->float('avg_voltage_r')->nullable();
            $table->float('avg_voltage_s')->nullable();
            $table->float('avg_voltage_t')->nullable();
            $table->float('avg_current_r')->nullable();
            $table->float('avg_current_s')->nullable();
            $table->float('avg_current_t')->nullable();
            $table->float('avg_watts_total')->nullable();
            $table->float('avg_var_total')->nullable();
            $table->float('cosphi')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->primary(['id_meter', 'record']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('load_profiles');
    }
};
