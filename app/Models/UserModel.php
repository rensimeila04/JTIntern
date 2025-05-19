<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_level',
        'remember_token'
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

    /**
     * Get the level associated with the user.
     */
    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    public function mahasiswa(){
        return $this->hasOne(MahasiswaModel::class, 'id_user', 'id_user');
    }

    public function notifikasi() {
        return $this->hasMany(NotifikasiModel::class, 'id_user', 'id_user');
    }
}
