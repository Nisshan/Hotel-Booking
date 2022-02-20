<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Place;
use App\Room;
use App\Service;
use App\Testimonial;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $data['rooms'] = Room::where('status', 1)->with('media')->latest()->take(7)->get();
        $data['facilities'] = Service::where('status', 1)->with('media')->latest()->take(4)->get();
        $data['places'] = Place::where('status', 1)->with('media')->latest()->take(5)->get();
        $data['testimonials'] = Testimonial::where('status', 1)->with('media')->latest()->take(4)->get();

        return view('frontend.index')->with($data);
    }
}
