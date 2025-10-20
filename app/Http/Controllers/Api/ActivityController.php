<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    /**
     * PATCH /api/activities/{activity}
     * Update activity dates/status/assignee/weight
     */
    public function update(Request $req, $id)
    {
        $activity = Activity::findOrFail($id);

        $payload = $req->validate([
            'title' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'assignee_id' => ['nullable', 'integer', Rule::exists('users','id')],
            'weight' => ['nullable', 'numeric'],
            'status' => ['nullable', Rule::in(['planned','ongoing','finished'])],
        ]);

        $activity->fill($payload);
        $activity->save();

        return response()->json($activity);
    }
}
