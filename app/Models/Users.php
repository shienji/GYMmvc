<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'user';
    //protected $waktu = date('Y-m-d');
    protected $fillable = [
        'user_nama',
        'user_email',
        'user_password',
        'user_nik' => '123456789',
        //'user_tgllahir' => $waktu,
        'user_nohp' => '123456789',
        'user_role',
        'user_status' => 'Process',
        //'created_at' => date('Y-m-d H:i:s'),
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['user_password'] = bcrypt($value);
    }
}
