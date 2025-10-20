<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index()
    {
        // The front-end fetches data from /api endpoints.
        return view('logbook.index');
    }
}
