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

    // can't handle event that goes across with this algorithm
    function scheduleEvents(Request $request){
        //event you wanna insert from input form
        $eventScheduling = new Event();
        $eventScheduling->dateFrom = $request->dateFrom;
        $eventScheduling->dateTo = $request->dateTo;
        $eventScheduling->timeFrom = $request->timeFrom;
        $eventScheduling->timeTo = $request->timeTo;
        
        var_dump($this->getAvailableDates($eventScheduling));
    }
    
    //*-- get all the available dates (=insertable dates) from dateFrom to dateTo --*//
    function getAvailableDates($eventScheduling){
        $dateFrom2Search = new \DateTime($eventScheduling->dateFrom);
        $dateTo2Search = new \DateTime($eventScheduling->dateTo);
        $dateDiff2Search = $dateFrom2Search->diff($dateTo2Search)->days;

        $availableDates = [];
        for($i=0; $i<$dateDiff2Search+1; $i++){
            $dateFrom2Search_ = clone $dateFrom2Search; //clone dateFrom2Search to avoid reference parse
            $dateFrom2Search_->add(new \DateInterval("P".$i."D")); //move to next day
            $dateFrom2SearchFormatted = $dateFrom2Search_->format('Y-m-d'); //format to manipulating-friendly
            // echo "i:$i df2s:$dateFrom2SearchFormatted, ";
            $events = Event::where('dateFrom', '=', $dateFrom2SearchFormatted)->get(); //get events starting on the same date
            
            //determine if $event is insertable(=$available) somewhere bet $events and save to array(=$availableDates)
            $available = true;
            foreach($events as $event){
                $interected = $this->isIntersected($event, $eventScheduling);
                if($interected){
                    $available = false;
                    break;
                }
            }
            if($available){
                array_push($availableDates, $dateFrom2SearchFormatted);
            }
        }
        
        return $availableDates;
    }

    function isIntersected($event, $event2){
        //convert time column data to DateTime object
        $eventTime = ["from" => new \DateTime($event->timeFrom), "to" => new \DateTime($event->timeTo)];
        $event2Time = ["from" => new \DateTime($event2->timeFrom), "to" => new \DateTime($event2->timeTo)];
        
        //get each time length
        $interval = $event2Time['from']->getTimestamp() - $eventTime['from']->getTimestamp();
        
        $bothActualTimeLength = ($interval<0) ? 
            $eventTime['to']->getTimestamp() - $event2Time['from']->getTimestamp() :
            $event2Time['to']->getTimestamp() - $eventTime['from']->getTimestamp();
        $eventTimeLength = $eventTime['to']->getTimestamp() - $eventTime['from']->getTimestamp();
        $event2TimeLength = $event2Time['to']->getTimestamp() - $event2Time['from']->getTimestamp();
        $bothShortestTimeLength = $eventTimeLength + $event2TimeLength;
        
        // echo "both:  $bothTimeLength, ";
        // echo "event: $eventTimeLength, ";
        // echo "event2:$event2TimeLength, ";
        
        //if length of event to event2 is smaller than length of event and event2, intersected!
        return $bothActualTimeLength - $bothShortestTimeLength < 0;
    }
}
