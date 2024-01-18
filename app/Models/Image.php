<?php
// app/Models/Image.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $table = "images";
    public $timestamps = false;
    protected $fillable = ['user_id', 'nazev_obrazku'];

    // Další potřebné definice, např. vztahy a další
}
