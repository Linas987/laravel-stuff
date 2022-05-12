<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class InvalidCard extends Model
{
    use HasFactory,Notifiable;

    protected $table='invalid_card';

    protected $fillable =[
        'doctor_id',
        'session_name',
        'Observations',
        'name',
        'surname',
    ];

    public function doctor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Doctor::class)->withDefault();
    }
}
