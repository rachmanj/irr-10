<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function plant_type()
    {
        return $this->belongsTo(PlantType::class)->withDefault([
            'name' => 'n/a'
        ]);
    }
}
