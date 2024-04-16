<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'type' , 'is_active' , 'puce'
    ];
    final public function Puce() : HasOne {
        return $this->hasOne(Puce::class ,'id', 'puce');
    }
}
