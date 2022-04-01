<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    public $timestamps = false;
    use HasFactory,Notifiable;

    protected $guard ='doctor';

    protected $table='doctors';

    protected $fillable =[
      'name',
      'email',
      'password',
      'occupation',
      'surname',
      'username',
    ];

    public function users()
    {
    //  return $this->belongsToMany('App\User');
    return $this->belongsToMany(User::class)->withPivot('Times','date_register','id');
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    // this is a recommended way to declare event handlers
   /*
    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            $user->photos()->delete();
            // do the rest of the cleanup...
        });
    }
   */
}
