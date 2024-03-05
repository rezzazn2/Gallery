<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'foto_id',
        'user_id',
        'laporan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function foto(){
        return $this->belongsTo(Foto::class);
    }

}
