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
        Schema::create('gateways', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('meter_id')->constrained('meters')->onDelete('cascade');
            $table->integer("listening_port")->unique();
            $table->string('heartbeat')->unique()->nullable();
            $table->enum('enabled', ['yes', 'no'])->default('no');
            $table->enum('mode', ['intranet', 'internet'])->default('intranet');
            $table->enum('status', ['connect', 'disconnect'])->default('disconnect');
            $table->string('last_error')->nullable();
            $table->timestamp("last_connected_at")->nullable();
            $table->timestamp("last_dial_at")->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
