<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instantaneous extends Model
{
    protected $table = 'instantaneous';
    protected static function booted()
    {
        static::retrieved(function ($model) {
            $model->applyCtRatioToAttributes();
        });
    }

    private function applyCtRatioToAttributes()
    {
        $meter = $this->meter;
        if ($meter->ct_mul && $meter->ct_mul != 1) {
            foreach (
                [
                    'current_r',
                    'current_s',
                    'current_t',
                ] as $attr
            ) {
                if (isset($this->attributes[$attr])) {
                    $value = $this->attributes[$attr] * $meter->ct_mul;
                    $this->attributes[$attr] = round($value, 3);
                }
            }
        }
        if ($meter->vt_mul && $meter->vt_mul != 1) {
            foreach (
                [
                    'voltage_r',
                    'voltage_s',
                    'voltage_t',
                ] as $attr
            ) {
                if (isset($this->attributes[$attr])) {
                    $value = $this->attributes[$attr] * $meter->vt_mul;
                    $this->attributes[$attr] = round($value, 1);
                }
            }
        }
        if ($meter->ct_vt_mul && $meter->ct_vt_mul != 1) {
            foreach (
                [
                    'power_active_import',
                    'power_reactive_import',
                    'power_apparent_import',
                    'power_active_export',
                    'power_reactive_export',
                    'power_apparent_export',
                    'export_energy_rate1',
                    'export_energy_rate2',
                    'export_energy_total',
                    'import_energy_rate1',
                    'import_energy_rate2',
                    'import_energy_total',
                    'kvar_energy_export',
                    'kvar_energy_import',
                ] as $attr
            ) {
                if (isset($this->attributes[$attr])) {
                    $value = $this->attributes[$attr];
                    $this->attributes[$attr] = round(($value * $meter->ct_vt_mul) / 1000, 3);
                }
            }
        }
    }

    public function meter()
    {
        return $this->belongsTo(Meter::class, 'id_meter');
    }
}
