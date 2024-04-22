<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricule' , 'nom' , 'prenom' , 'entity'
    ];

    final public function entity() {
        return $this->belongsTo(Entity::class , "entity" , "id");
    }
}
