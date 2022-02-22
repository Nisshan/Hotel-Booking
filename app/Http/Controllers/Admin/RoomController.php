<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Room;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Yajra\DataTables\DataTables;

/**
 * Class RoomController
 * @package App\Http\Controllers\Admin
 */
class RoomController extends Controller
{

    public function getRooms() : Response
    {
        $has_view = false;
        $has_edit = false;
        $has_delete = false;
        if (auth()->user()->can('view_room')) {
            $has_view = true;
        }
        if (auth()->user()->can('edit_room')) {
            $has_edit = true;
        }
        if (auth()->user()->can('delete_room')) {
            $has_delete = true;
        }

        return DataTables::of(Room::query())
            ->addColumn('actions', function ($room) use ($has_view, $has_edit, $has_delete) {
                $view = "";
                if ($has_view) {
                    $view = view('admin.datatables.action-view')
                        ->with(['route' => route('rooms.show', ['room' => $room->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('admin.datatables.action-edit')
                        ->with(['route' => route('rooms.edit', ['room' => $room->id])])->render();
                    $view .= $edit;
                }
                if ($has_delete) {
                    $delete = view('admin.datatables.action-delete')
                        ->with(['route' => route('rooms.destroy', ['room' => $room->id])])->render();
                    $view .= $delete;
                }

                return $view;
            })->rawColumns(['actions'])
            ->make('true');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        if (! Gate::allows('view_room')) {
            return abort(401);
        }

        return view('admin.rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! Gate::allows('create_room')) {
            return abort(401);
        }

        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Gate::allows('create_room')) {
            return abort(401);
        }
        $room = new Room();
        $room->type = $request->type;
        $room->description = $request->description;
        $room->facilities = $request->facilities;
        $room->user_id = auth()->id();
        $room->price = $request->price;
        $room->capacity = $request->capacity;
        $room->room_no = $request->room_no;
        $room->slug = Str::slug($request->room_no);
        $room->addMediaFromRequest('cover')
            ->toMediaCollection('room-cover');

        foreach ($request->file('images') as $image) {
            $room->addMedia($image)
                ->toMediaCollection('rooms');
        }

        $room->save();
        flash('Created Successfully')->success();

        return redirect()->action('Admin\RoomController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @return View
     */
    public function show(Room $room): View
    {
        if (! Gate::allows('view_room')) {
            return abort(401);
        }

        return view('admin.rooms.view',[
            'room' => $room,
            'images' => $room->getMedia('rooms')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Room $room
     * @return View
     */
    public function edit(Room $room): View
    {
        if (! Gate::allows('edit_room')) {
            return abort(401);
        }

        return view('admin.rooms.edit',[
            'room' => $room
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Room $room
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Room $room): RedirectResponse
    {
        if (! Gate::allows('edit_room')) {
            return abort(401);
        }

        $room->type = $request->type;
        $room->description = $request->description;
        $room->facilities = $request->facilities;
        $room->status = $request->status ;
        $room->price = $request->price;
        $room->capacity = $request->capacity;
        $room->room_no = $request->room_no;
        if ($request->cover) {
            $room->getFirstMedia('room-cover')->delete();
            $room->addMediaFromRequest('cover')
                ->toMediaCollection('room-cover');
        }
        if ($request->images) {
            $room->clearMediaCollection('rooms');
            foreach ($request->file('images') as $image) {
                $room->addMedia($image)
                    ->toMediaCollection('rooms');
            }
        }
        $room->save();
        flash('Updated Successfully')->success();

        return redirect()->action('Admin\RoomController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Room $room
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Room $room): RedirectResponse
    {
        if (! Gate::allows('delete_room')) {
            flash('Not Authorized To delete room')->error();

            return back();
        }
        $room->delete();
        flash('deleted Successfully');

        return back();
    }
}
