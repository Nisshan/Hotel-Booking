<?php

namespace App\Http\Controllers\Frontend;

use App\BookRoom;
use App\Http\Controllers\Controller;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class BookingController
 * @package App\Http\Controllers\Frontend
 */
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();

        return view('frontend.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date_to = Carbon::parse($request->date_to)->toDateTime();
        $date_form = Carbon::parse($request->date_from)->toDateTime();
        $book = new BookRoom();
        $book->to = $date_to;
        $book->from = $date_form;
        $book->name = $request->name;
        $book->email = $request->email;
        $book->number = $request->number;
        $book->address = $request->address ? $request->address : 'Itahari';
        $book->room_id = $request->room_id;
        $book->save();
        flash('Thank You We will reply you shortly')->success();
        $data = Room::findorFail($request->room_id);

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
