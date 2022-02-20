<?php

namespace App\Http\Controllers\Admin;

use App\BookRoom;
use App\Http\Controllers\Controller;
use App\Place;
use App\Room;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

/**
 * Class RoomBookingController
 * @package App\Http\Controllers\Admin
 */
class RoomBookingController extends Controller
{
    public function getBookedRoom()
    {
        $has_view = true;
        $has_edit = true;
        $has_delete = true;
//        if (auth()->user()->can('view_place')) {
//            $has_view = true;
//        }
//        if (auth()->user()->can('edit_place')) {
//            $has_edit = true;
//        }
//        if (auth()->user()->can('delete_place')) {
//            $has_delete = true;
//        }
        return DataTables::of(BookRoom::with('room')->get())
            ->addColumn('actions', function ($bookroom) use ($has_view, $has_edit, $has_delete) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($has_view) {
                    $view = view('admin.datatables.action-view')
                        ->with(['route' => route('booking.show', ['booking' => $bookroom->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('admin.datatables.action-edit')
                        ->with(['route' => route('booking.edit', ['booking' => $bookroom->id])])->render();
                    $view .= $edit;
                }
                if ($has_delete) {
                    $delete = view('admin.datatables.action-delete')
                        ->with(['route' => route('booking.destroy', ['booking' => $bookroom->id])])->render();
                    $view .= $delete;
                }

                return $view;
            })->editColumn('from', function ($bookroom) {
                return Carbon::parse($bookroom->from)->format('d M Y');
            })->editColumn('to', function ($bookroom) {
                return Carbon::parse($bookroom->to)->format('d M Y');
            })->editColumn('room_id', function ($bookroom) {
                return $bookroom->room->room_no;
            })->editColumn('price', function ($bookroom) {
                return $bookroom->room->price;
            })->rawColumns(['actions'])
            ->make('true');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $rooms = Room::with('booking')->get();
//        dd($rooms);
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
        $book = new BookRoom();
        $book->to = $date_to;
        $book->from = $date_form;
        $book->name = 'Sunkoshi';
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
        $booking = BookRoom::with('room')->findorfail($id);

        return view('admin.bookings.edit', compact('booking'));
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
//        $date_to = Carbon::parse($request->date_to)->toDateTime();
        $booking = BookRoom::find($id);
        $date_to = $booking->to;
        $date_from = $booking->from;

        $booking->status = $request->status;
        $booking->save();
        flash('Information Updated Successfully, Email Sent')->success();
        Mail::send(
            'mail.send-mail',
            [
                'name' => $request->name,
                'from' => $date_from,
                'to' => $date_to,

                'status' => $request->status,
                'room_no' => $request->room_no,
            ],
            function ($message) {
                $message->to('timsinanishan1@gmail.com');
            }
        );

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
        $booking = BookRoom::find($id);
        $booking->delete();
        flash('Deleted sucessfully');

        return back();
    }
}
