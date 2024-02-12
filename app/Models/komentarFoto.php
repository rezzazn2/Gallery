<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentarFoto extends Model
{
    use HasFactory;

    protected $table = 'komentarFoto';

    protected $fillable = [
        'fotoId',
        'userId',
        'isiKomentar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }


}
