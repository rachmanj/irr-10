<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'equipments';

    public function unitmodel()
    {
        return $this->belongsTo(Unitmodel::class)->withDefault([
            'model_no' => 'n/a'
        ]);
    }

    public function model()
    {
        return $this->belongsTo(Unitmodel::class, 'unitmodel_id', 'id')->withDefault(['model_no' => 'n/a']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'n/a'
        ]);
    }

    public function unitstatus()
    {
        return $this->belongsTo(Unitstatus::class)->withDefault([
            'name' => 'n/a'
        ]);
    }

    public function current_project()
    {
        return $this->belongsTo(Project::class, 'current_project_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function moving_details()
    {
        return $this->hasMany(MovingDetail::class);
    }

    public function plant_type()
    {
        return $this->belongsTo(PlantType::class)->withDefault([
            'name' => 'n/a'
        ]);
    }

    public function asset_category()
    {
        return $this->belongsTo(AssetCategory::class)->withDefault([
            'name' => 'n/a'
        ]);
    }

    public function unitno_histories()
    {
        return $this->hasMany(UnitnoHistory::class)->orderby('date', 'desc');
    }

    public function plant_group()
    {
        return $this->belongsTo(PlantGroup::class, 'plant_group_id', 'id')->withDefault([
            'name' => 'n/a'
        ]);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withDefault([
            'name' => 'System Admin'
        ]);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')->withDefault([
            'name' => 'System Admin'
        ]);
    }

    public function photos()
    {
        return $this->hasMany(EquipmentPhoto::class);
    }

    protected static function boot()
    {
        parent::boot();
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }
}
