<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Puce;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Affectation extends Model
{
    use HasFactory;
    protected $fillable = [
        'puce' , 'personnel' , 'observation' , 'date_affectation'
    ];

    final public function Puce() : HasOne {
        return $this->hasOne(Puce::class , "id" , "puce");
    }
    final public function Personnel() : HasOne {
        return $this->hasOne(Personnel::class , "id" , "personnel");
    }
}
