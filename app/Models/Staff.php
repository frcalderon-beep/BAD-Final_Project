<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'personal_info',
        'assigned_appointment',
        'contact_info',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Model booted callback to cascade-delete related models when a staff
     * member is removed. This prevents foreign key constraint errors when
     * appointments or schedules reference the staff record.
     */
    protected static function booted(): void
    {
        static::deleting(function (Staff $staff) {
            // Remove dependent appointments and schedules first
            // Use query delete to avoid firing too many model events; if you
            // need events for those models use ->each(fn($m) => $m->delete());
            $staff->appointments()->delete();
            $staff->schedules()->delete();
        });
    }
}
