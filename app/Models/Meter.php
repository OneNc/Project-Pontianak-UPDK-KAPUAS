<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'id_group',
        'name',
        'brand',
        'type',
        'ratio_vt',
        'ratio_ct',
        'ct_mul',
        'vt_mul',
        'ct_vt_mul',
        'nominal_v',
        'nominal_i',
        'classes',
        'serial_number',
        'ip_address',
        'active',
        'port',
    ];
    protected static function booted()
    {
        static::created(function ($model) {
            $model->ct_mul = $model->parseRatio($model->ratio_ct);
            $model->vt_mul = $model->parseRatio($model->ratio_vt);
            $model->ct_vt_mul = $model->ct_mul * $model->vt_mul;
            $model->save();
        });
        static::updating(function ($model) {
            $model->ct_mul = $model->parseRatio($model->ratio_ct);
            $model->vt_mul = $model->parseRatio($model->ratio_vt);
            $model->ct_vt_mul = $model->ct_mul * $model->vt_mul;
        });
    }
    private function parseRatio($ratio)
    {
        $parts = explode(':', $ratio);
        if (count($parts) == 2) {
            $numerator = floatval($parts[0]);
            $denominator = floatval($parts[1]);
            if ($denominator != 0) {
                return $numerator / $denominator;
            }
        }
        return 1;
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function latestInstant()
    {
        return $this->hasOne(Instantaneous::class, 'id_meter')->latestOfMany();
    }
    public function lastUpdate()
    {
        return $this->hasOne(Instantaneous::class, 'id_meter')->latestOfMany('created_at');
    }
}
