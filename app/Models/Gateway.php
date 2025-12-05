<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Gateway extends Model
{
    use HasUuids;

    protected $table = 'gateways';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Hanya field yang diinput user + aman di-mass assign
    protected $fillable = [
        'meter_id',
        'listening_port',
        'heartbeat',
        'enabled',
        'mode'
    ];

    protected $casts = [
        'listening_port'    => 'integer',
        'last_connected_at' => 'datetime',
        'last_dial_at'      => 'datetime',
    ];

    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }
}
