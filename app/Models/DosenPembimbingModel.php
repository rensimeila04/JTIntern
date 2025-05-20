<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPembimbingModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosen_pembimbing';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_dosen_pembimbing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'nip',
        'bidang_minat',
    ];

    /**
     * Get the user that owns the dosen pembimbing.
     */
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }
    
    public function magang() {
        return $this->hasMany(MagangModel::class, 'id_dosen_pembimbing', 'id_dosen_pembimbing');
    }
}
