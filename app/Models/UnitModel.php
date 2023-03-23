<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class)->withDefault([
            'name' => 'n/a'
        ]);
    }
}
