<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'level';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_level';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_level',
        'nama_level',
    ];

    /**
     * Get the users for this level.
     */
    public function users()
    {
        return $this->hasMany(UserModel::class, 'id_level', 'id_level');
    }
}