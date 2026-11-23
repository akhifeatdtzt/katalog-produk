<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'kategori',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
    ];
}