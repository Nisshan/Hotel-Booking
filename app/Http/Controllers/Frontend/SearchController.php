<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Room;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class SearchController
 * @package App\Http\Controllers\Frontend
 */
class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function search(Request $request){
//        dd($request);
        $time_from = Carbon::parse($request->from)->toDateTime();
        $time_to =  Carbon::parse($request->to)->toDateTime();

        if ($request->isMethod('POST')) {
            $rooms = Room::with('booking','media')->where('status',1)->whereHas('booking', function ($q) use ($time_from, $time_to) {
                $q->where(function ($q2) use ($time_from, $time_to) {
                    $q2->where('from', '>=', $time_to)
                        ->orWhere('to', '<=', $time_from);
                });
            })->orWhereDoesntHave('booking')->get();
        } else {
            $rooms = null;
        }
        return view('frontend.search.available',compact('rooms','time_from','time_to'));
    }
}
