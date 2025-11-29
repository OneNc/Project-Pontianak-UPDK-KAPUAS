<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];
    public function meters()
    {
        return $this->hasMany(Meter::class, 'id_group');
    }
}
