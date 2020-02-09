<?php

namespace App\Http\Controllers\Admin;

use App\BookRoom;
use App\Http\Controllers\Controller;
use App\Room;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class RoomBookingController
 * @package App\Http\Controllers\Admin
 */
class RoomBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */

    public function create()
    {
        $rooms = Room::all();
        return view('admin.bookings.create', compact('rooms'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $date_to = Carbon::parse($request->date_to)->toDateTime();
        $date_form = Carbon::parse($request->date_from)->toDateTime();
        $book = new BookRoom;
        $book->to = $date_to;
        $book->from =$date_form;
        $book->name ='Sunkoshi';
        $book->email = 'Sunkoshi@gmail.com';
        $book->number = '00000';
        $book->address = 'itahari';
        $book->room_id = $request->room_id;
        $book->status = 1;
        $book->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $booking = BookRoom::findorfail($id);
//        dd($booking);
        return view('admin.bookings.edit',compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $date_to = Carbon::parse($request->date_to)->toDateTime();
        $booking = BookRoom::find($id);
        $booking->to = $date_to;
        $booking->status = $request->status;
        $booking->save();
        flash('Room Booked Successfully, Email Sent')->success();
        return redirect()->action('Admin\RoomBookingController@create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
