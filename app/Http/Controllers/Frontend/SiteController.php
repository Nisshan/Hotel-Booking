<?php

namespace App\Http\Controllers\Frontend;

use App\BookRoom;
use App\Http\Controllers\Controller;
use App\Place;
use App\Room;
use App\Service;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class SiteController
 * @package App\Http\Controllers\Frontend
 */
class SiteController extends Controller
{
    /**
     * @return View
     */
    public function rooms(): View
    {
        return view('frontend.categorypage.rooms',[
            'rooms' => Room::where('status', 1)->with('media')->latest()->get()
        ]);
    }

    /**
     * @return View
     */
    public function services(): View
    {
        return view('frontend.categorypage.services',[
            'services' => Service::where('status', 1)->with('media')->latest()->get()
        ]);
    }

    /**
     * @return View
     */
    public function places(): View
    {
        return view('frontend.categorypage.places',[
            'places' => Place::where('status', 1)->with('media')->latest()->get()
        ]);
    }

    /**
     * @param int $room
     * @return View
     */
    public function singleRoom(int $room): View
    {
        $data['room'] = Room::where('room_no', $room)->with('media')->with('booking')->firstorFail();
        $disabledates = BookRoom::select('id', 'from', 'to')->where('room_id', $data['room']->id)->where('status', 1)->get();

        //refactor all these name when doing test
        $nishan = [];
        foreach ($disabledates as $dates) {
            $disdate = [];
            $dates = CarbonPeriod::create($dates->from, $dates->to);
            foreach ($dates as $date) {
                $disdate[] = Carbon::parse($date)->format('m-d-Y');
            }
            $nishan[] = $disdate;
        }
        $data['disabledates'] = [];
        foreach ($nishan as $nis) {
            foreach ($nis as $n) {
                $data['disabledates'][] = $n;
            }
        }
        $data['dates'] = BookRoom::where('room_id', $data['room']->id)->where('status', 1)->pluck('to')->toArray();
        return view('frontend.singlepage.singleroom')->with($data);
    }

    /**
     * @param string $name
     * @return View
     */
    public function visitPlace(string $name): View
    {

        return view('frontend.singlepage.placetovisit',[
            'place' =>  Place::where('name', $name)->with('media')->firstOrFail()
        ]);
    }

    /**
     * @param string $name
     * @return View
     */
    public function servicePage(string $name): View
    {
        return view('frontend.singlepage.servicepage',[
            'service' => Service::where('name', $name)->with('media')->firstorfail()
        ]);
    }
}
