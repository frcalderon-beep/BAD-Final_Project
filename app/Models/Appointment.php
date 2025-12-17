<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_id',
        'client_id',
        'staff_id',
        'service_type_id',
        'service_name',
        'appointment_date_time',
        'personal_references',
        'appointment_status',
        'notes',
    ];

    protected $casts = [
        'appointment_date_time' => 'datetime',
    ];

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }
}
