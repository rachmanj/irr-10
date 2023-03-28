<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function store($user, $activity_type, $model = null, $model_id = null)
    {
        Activity::create([
            'activity_type' => $activity_type,
            'user_id' => $user,
            'model' => $model,
            'model_id' => $model_id,
        ]);
    }
}
