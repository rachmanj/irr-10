<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
