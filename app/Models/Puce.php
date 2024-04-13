<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puce extends Model
{
    use HasFactory;
    protected $fillable = [
        'Type' , 'Fourniseur' , 'Puce' , 'Tel' , 'isActive'
    ];
}