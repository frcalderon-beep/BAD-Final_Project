<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'personal_info',
        'contact_info',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Cascade-delete related appointments when a client is deleted to
     * avoid foreign key constraint violations.
     */
    protected static function booted(): void
    {
        static::deleting(function (Client $client) {
            $client->appointments()->delete();
        });
    }
}
