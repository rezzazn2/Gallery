<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restore extends Model
{
    use HasFactory;

    protected $table = 'restore';

    protected $fillable = [
        'judulFoto',
        'deskripsiFoto',
        'albumId',
        'userId',
        'jalurFoto'
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

   
}
