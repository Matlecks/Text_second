<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    public function index()
    {
        /* $events = Event::all(); */
        $events = Cache::remember('events', 60, function () {
            return Event::all();
        });

        return view('index', compact('events'));
    }
    public function store(Request $request)
    {
        $event = new Event();
        $currentDate = Carbon::now();

        $diff = $currentDate->diffInDays($request->date, false);

        if ($diff >= 365) {
            $period = floor($diff / 365);
            $periodType = 'год';
        } elseif ($diff >= 30) {
            $period = floor($diff / 30);
            $periodType = 'месяц';
        } else {
            $period = $diff;
            $periodType = 'день';
        }

        if ($period >= 0) {
            $event->title = ($request->title);
            $event->place = ($request->place);
            $event->date = ($request->date);
            $event->period = $period;
            $event->period_type = $periodType;

            $event->save();

            Cache::remember('event', 300, function () use ($event) {
                return $event;
            });

            /* dispatch(new Queue($event)); */ //Добавляем в очередь. Ларавел ругается на Queue, поэтому закоментировано

        } else {
            $event->title = ($request->title);
            $event->place = ($request->place);
            $event->date = ($request->date);
            $event->period = $period;
            $event->period_type = $periodType;

            $event->save();

            Cache::remember('event', 300, function () use ($event) {
                return $event;
            });

            /* dispatch(new Queue($event)); */ //Добавляем в очередь. Ларавел ругается на Queue, поэтому закоментировано

        }

        return redirect()->route('index');
    }
}
