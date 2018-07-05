<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    function create(){
        return view('create');
    }

    function generateEvents(Request $request){
        $table = new Event();
        $table->dateFrom = $request->dateFrom;
        $table->dateTo = $request->dateTo;
        $table->timeFrom = $request->timeFrom;
        $table->timeTo = $request->timeTo;
        $table->title = $request->title;

        $table->save();
    }

    function scheduleEvents(Request $request){
        $events = Event::all();
        $eventScheduling = new Event();
        $eventScheduling->timeFrom = $request->timeFrom;
        $eventScheduling->timeTo = $request->timeTo;
        // var_dump($events);
        if($this->isIntersected($events[0], $eventScheduling)){
            echo "intersected!";
        }
        else {
            echo "NOT intersected!";
        }
    }

    function isIntersected($event, $event2){
        $l = new \DateTime($event2->timeFrom) - $event->timeFrom;
        $m = $event->timeTo - $event->timeFrom;
        $n = new \DateTime($event2->timeTo) - new \DateTime($event2->timeFrom);
        if( (l - m+n) < 0){ //if length of event to event2 is smaller than length of event and event2, intersected
            return true;
        }
        return false;
    }
}
