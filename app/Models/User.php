<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['time_difference'];  // this will add 'time_difference' attribute to the user object only for run time
    
    // below function would return the time difference between current time and user last appearance on the application
    public function getTimeDifferenceAttribute(){
    if($this->last_seen != NULL){    
        $to = Carbon::createFromFormat('Y-m-d H:i:s', now());
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $this->last_seen);
        $diff_in_minutes = $to->diffInMinutes($from);
    } else {
        $diff_in_minutes = 3;
    }   
        return $diff_in_minutes; 
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime', 
        'last_seen'  => 'date:d M H:i'     // this will convert the last_seen attribute into required date format only for run time
    ];
}
