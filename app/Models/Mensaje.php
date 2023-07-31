<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'contacto', 'area_id', 'mensaje'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
