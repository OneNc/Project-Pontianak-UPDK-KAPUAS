<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Agent;

class UserSession extends Model
{
    protected $table = 'sessions';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    protected $casts = [
        'last_activity' => 'integer',
    ];

    // atribut tambahan yang mau ikut ketika di-serialize (optional)
    protected $appends = [
        'last_active_human',
        'device_name',
        'platform_name',
        'browser_name',
        'is_mobile',
        'is_desktop',
        'is_current_device',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* ============ Agent helper ============ */

    protected function makeAgent(): Agent
    {
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);

        return $agent;
    }

    /* ============ Accessor ============ */

    public function getLastActiveHumanAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity)->diffForHumans();
    }

    public function getDeviceNameAttribute()
    {
        $agent = $this->makeAgent();
        return $agent->device() ?: 'Unknown device';
    }

    public function getPlatformNameAttribute()
    {
        $agent = $this->makeAgent();
        return $agent->platform() ?: 'Unknown OS';
    }

    public function getBrowserNameAttribute()
    {
        $agent = $this->makeAgent();
        return $agent->browser() ?: 'Unknown browser';
    }

    public function getIsMobileAttribute()
    {
        return $this->makeAgent()->isMobile();
    }

    public function getIsDesktopAttribute()
    {
        return $this->makeAgent()->isDesktop();
    }

    public function getIsCurrentDeviceAttribute()
    {
        return $this->id === session()->getId();
    }

    /* ============ Scope ============ */

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
