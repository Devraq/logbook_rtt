<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'job_id'      => $this->job_id,
            'parent_id'   => $this->parent_id,
            'title'       => $this->title,
            'description' => $this->description,
            'start_date'  => optional($this->start_date)->format('Y-m-d'),
            'end_date'    => optional($this->end_date)->format('Y-m-d'),
            'assignee_id' => $this->assignee_id,
            'weight'      => (float)$this->weight,
            'status'      => $this->status,
        ];
    }
}
