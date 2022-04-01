<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory,Notifiable;

    protected $table='card';

    protected $fillable =[
      'user_id',
      'doctor_id',
      'session_name',
      'Observations',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
            return $this->belongsTo(User::class)->withDefault();
        }
    public function doctor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Doctor::class)->withDefault();
    }
}
