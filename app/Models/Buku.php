<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'penulis', 'harga', 'tgl_terbit', 'photo'];
    protected $table = 'books'; //Menginisiasi Tabel mana yang mau di panggil
    protected $dates = ['tgl_terbit'];
}
