<?php

namespace App\Models;

use App\Constant\UploadPathConstant;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $guarded = [];

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
    ];

    // public function setPhotoAttribute($value)
    // {
    //     if ($value != null) {
    //         $this->attributes['photo'] = UploadPathConstant::PHOTO . $value;
    //     }
    // }

    // public function getPhotoAttribute()
    // {
    //     return $this->attributes['photo'] ?  URL::to('/') . '/' . $this->attributes['photo'] : null;
    // }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Hash the password on save/update.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
