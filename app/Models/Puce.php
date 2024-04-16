<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Puce extends Model
{
    use HasFactory;
    protected $fillable = [
        'type' , 'fourniseur' ,'telephone' , 'is_active'
    ];

    final public function affectation() : BelongsTo {
        return $this->belongsTo(Affectation::class);
    }
    final public function status() : string {
        if ($this->is_active) {
            return "Active";
        }
        return "Desactiver";
    }
}