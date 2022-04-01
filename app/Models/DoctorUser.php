<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorUser extends Model
{
    use HasFactory;

    protected $table='doctor_user';

    public $timestamps = false;

    protected $fillable =[
        'date_register',
        'user_id',
        'doctor_id',
        'Times',
    ];
}
