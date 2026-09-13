<?php
namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    use HasFactory;

    protected $table = 'umkms';

    protected $fillable = [
        'nama',
        'gambar',
        'deskripsi',
        'link',
    ];
}
