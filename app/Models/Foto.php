<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';

    protected $fillable = [
        'judulFoto',
        'deskripsiFoto',
        'albumId',
        'userId',
        'jalurFoto'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'albumId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function albums() {
        return $this->belongsToMany(Album::class, 'album_foto')->withTimestamps();
    }

    public function likes() {
        return $this->hasMany(LikeFoto::class);
    }

}
