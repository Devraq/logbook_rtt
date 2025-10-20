<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'job_id'        => $this->job_id,
            'activity_id'   => $this->activity_id,
            'user_id'       => $this->user_id,
            'date'          => optional($this->date)->format('Y-m-d'),
            'hours'         => $this->hours !== null ? (float)$this->hours : null,
            'percent'       => (float)$this->percent,
            'description'   => $this->description,
            'evidence_url'  => $this->evidence_url,
        ];
    }
}
