<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Place;
use App\Room;
use App\Service;
use App\Testimonial;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('frontend.index', [
            'rooms' => Room::where('status', 1)->with('media')->latest()->take(7)->get(),
            'facilities' => Service::where('status', 1)->with('media')->latest()->take(4)->get(),
            'places' => Place::where('status', 1)->with('media')->latest()->take(5)->get(),
            'testimonials' => Testimonial::where('status', 1)->with('media')->latest()->take(4)->get(),
        ]);
    }
}
