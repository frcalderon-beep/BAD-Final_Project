<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'system_id',
        'time',
        'available_slots',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }
}
