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
        Schema::create('meters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_group')->nullable()->constrained('groups')->onDelete('cascade');
            $table->string('name');
            $table->string('brand');
            $table->string('type');
            $table->string('ratio_vt')->nullable()->default('1:1');
            $table->string('ratio_ct')->nullable()->default('1:1');
            $table->integer('ct_mul')->nullable()->default(1);
            $table->integer('vt_mul')->nullable()->default(1);
            $table->integer('ct_vt_mul')->nullable()->default(1);
            $table->string('nominal_v')->nullable();
            $table->string('nominal_i')->nullable();
            $table->string('classes')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('ip_address')->nullable();
            $table->integer('port')->nullable();
            $table->enum('status', ['connect', 'disconnect', 'wrong']);
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meters');
    }
};
