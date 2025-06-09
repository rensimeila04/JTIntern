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
        'profile_photo',
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

    public function admin() {
        return $this->hasOne(AdminModel::class, 'id_user', 'id_user');
    }

    public function dosenPembimbing() {
        return $this->hasOne(DosenPembimbingModel::class, 'id_user', 'id_user');
    }

    /**
     * Boot method to set up model event hooks
     */
    protected static function boot()
    {
        parent::boot();
        
        // When a user is deleted, also delete related records
        static::deleting(function ($user) {
            // Delete related models based on user level
            if ($user->mahasiswa) {
                // Delete related documents first to avoid foreign key constraint errors
                \App\Models\DokumenModel::where('id_mahasiswa', $user->mahasiswa->id_mahasiswa)->delete();
                $user->mahasiswa->delete();
            }
            
            if ($user->dosenPembimbing) {
                $user->dosenPembimbing->delete();
            }
            
            if ($user->admin) {
                $user->admin->delete();
            }
        });
    }
}
