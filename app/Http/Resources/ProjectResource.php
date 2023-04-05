<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'project_code' => $this->project_code,
            'bowheer' => $this->bowheer,
            'location' => $this->location,
        ];
    }
}
