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
     * @return Factory|View
     */
    public function rooms()
    {
        $data['rooms'] = Room::where('status', 1)->with('media')->latest()->get();

        return view('frontend.categorypage.rooms')->with($data);
    }

    /**
     * @return Factory|View
     */
    public function services()
    {
        $data['services'] = Service::where('status', 1)->with('media')->latest()->get();

        return view('frontend.categorypage.services')->with($data);
    }

    public function places()
    {
        $data['places'] = Place::where('status', 1)->with('media')->latest()->get();

        return view('frontend.categorypage.places')->with($data);
    }

    /**
     * @param $room
     * @return Factory|View
     */
    public function singleRoom($room)
    {
        $data['room'] = Room::where('room_no', $room)->with('media')->with('booking')->firstorFail();
        $disabledates = BookRoom::select('id', 'from', 'to')->where('room_id', $data['room']->id)->where('status', 1)->get();

        $nishan = [];
        foreach ($disabledates as $dates) {
            $disdate = [];
            $dates = CarbonPeriod::create($dates->from, $dates->to);
            foreach ($dates as $date) {
                array_push($disdate, Carbon::parse($date)->format('m-d-Y'));
            }
            array_push($nishan, $disdate);
        }
//        dd($nishan);
        $data['disabledates'] = [];
        foreach ($nishan as $nis) {
            foreach ($nis as $n) {
                $data['disabledates'][] = $n;
            }
        }
//        dd($data['disabledates']);
        $data['dates'] = BookRoom::where('room_id', $data['room']->id)->where('status', 1)->pluck('to')->toArray();
//                dd($data['dates']);
//        $data['disabledates'] = [];
//        foreach ($data['dates'] as $date) {
//            array_push($data['disabledates'],Carbon::parse($date)->format('m-d-Y')) ;
//        }
//        dd($data['disabledates']);
        return view('frontend.singlepage.singleroom')->with($data);
    }

    public function visitPlace($name)
    {
        $data['place'] = Place::where('name', $name)->with('media')->firstorFail();

        return view('frontend.singlepage.placetovisit')->with($data);
    }

    public function servicePage($name)
    {
        $data['service'] = Service::where('name', $name)->with('media')->firstorfail();

        return view('frontend.singlepage.servicepage')->with($data);
    }
}
