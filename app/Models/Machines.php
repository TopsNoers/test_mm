<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machines extends Model
{
    protected $table = 'machines';
    protected $fillable = ['name', 'location', 'status', 'created_at', 'updated_at'];

    public function readings()
    {
        return $this->hasMany(Readings::class);
    }

    public function reading()
    {
        return $this->hasOne(Readings::class)->latest();
    }
}
