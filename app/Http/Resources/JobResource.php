<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'description'     => $this->description,
            'start_date'      => optional($this->start_date)->format('Y-m-d'),
            'end_date'        => optional($this->end_date)->format('Y-m-d'),
            'weight'          => (float)$this->weight,
            'created_by'      => $this->created_by,
            'status'          => $this->status,
            'latest_progress' => (float)($this->latest_progress ?? 0),
            'activity_count'  => (int)($this->activity_count ?? 0),
            'activities'      => ActivityResource::collection($this->whenLoaded('activities')),
            // Keep assignees but hide pivot internals:
            'assignees'       => $this->whenLoaded('assignees', function () {
                return $this->assignees->map(fn($u) => [
                    'id' => $u->id, 'name' => $u->name, 'role' => $u->pivot->role ?? null,
                ]);
            }),
        ];
    }
}
