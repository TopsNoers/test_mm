<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Readings extends Model
{
    protected $table = 'readings';
    protected $fillable = ['machine_id', 'temperature', 'conveyor_speed', 'recorded_at', 'created_at', 'updated_at'];

    public function machine()
    {
        return $this->belongsTo(Machines::class);
    }
}
