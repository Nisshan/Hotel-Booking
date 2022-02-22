<?php

namespace App\Http\Controllers\Frontend;

use App\BookRoom;
use App\Http\Controllers\Controller;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class BookingController
 * @package App\Http\Controllers\Frontend
 */
class BookingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('frontend.create', [
            'rooms' => Room::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $date_to = Carbon::parse($request->date_to)->toDateTime();
        $date_form = Carbon::parse($request->date_from)->toDateTime();
        $book = new BookRoom();
        $book->to = $date_to;
        $book->from = $date_form;
        $book->name = $request->name;
        $book->email = $request->email;
        $book->number = $request->number;
        $book->address = $request->address ?: 'Itahari';
        $book->room_id = $request->room_id;
        $book->save();
        flash('Thank You We will reply you shortly')->success();
        $data = Room::findOrFail($request->room_id);

        Mail::send(
            'mail.receive-mail',
            [
                'name' => $request->name,
                'number' => $request->number,
                'email' => $request->email,
                'from' => $request->date_from,
                'to' => $request->date_to,
                'room_no' => $data->room_no,
             ],
            function ($message) {
                $message->to('timsinanishan1@gmail.com');
            }
        );

        return back();
    }
}
