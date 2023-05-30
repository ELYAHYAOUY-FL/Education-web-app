<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
     
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->title = $request->input('title');
        $event->date = $request->input('date');
        $event->color = $request->input('color');
        $event->description = $request->input('description');
        
        $event->save();

        return response()->json($event);
    }
}
