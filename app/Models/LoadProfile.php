<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadProfile extends Model
{
    protected $table = 'load_profiles';
    protected $primaryKey = ['id_meter', 'record'];
    public $incrementing = false;
    protected $keyType = 'int';
    protected static function booted()
    {
        static::retrieved(function ($model) {
            $model->applyCtRatioToAttributes();
        });
    }
    private function applyCtRatioToAttributes()
    {
        $meter = $this->meter;
        $ratio = 1;
        if ($meter && !empty($meter->ratio_ct) && $meter->ratio_ct != '1:1') {
            $parts = explode(':', $meter->ratio_ct);
            if (count($parts) == 2 && is_numeric($parts[0]) && is_numeric($parts[1]) && $parts[1] != 0) {
                $ratio = floatval($parts[0]) / floatval($parts[1]);
            }
        }
        foreach (
            [
                'voltage_r',
                'voltage_s',
                'voltage_t',
                'current_r',
                'current_s',
                'current_t',
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
                $value = $this->attributes[$attr] * $ratio;
                if (str_starts_with($attr, 'voltage_')) {
                    $this->attributes[$attr] = round($value, 1);
                } elseif (str_starts_with($attr, 'ampere_')) {
                    $this->attributes[$attr] = round($value, 3);
                } elseif (
                    str_starts_with($attr, 'power_') ||
                    str_starts_with($attr, 'export_') ||
                    str_starts_with($attr, 'import_') ||
                    str_starts_with($attr, 'kvar_')
                ) {
                    $this->attributes[$attr] = round($value / 1000, 3);
                } else {
                    $this->attributes[$attr] = $value;
                }
            }
        }
    }
    public function meter()
    {
        return $this->belongsTo(Meter::class, 'id_meter');
    }
}
