<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Room;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Psy\Util\Str;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Yajra\DataTables\DataTables;

/**
 * Class RoomController
 * @package App\Http\Controllers\Admin
 */
class RoomController extends Controller
{
    /**
     * @return mixed
     * @throws Exception
     */
    public function getRooms()
    {
        $has_view = true;
        $has_edit = true;
        $has_delete = true;
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
                $edit = "";
                $delete = "";
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
     * @return Factory|View
     */
    public function index()
    {
        if (! Gate::allows('view_room')) {
            return abort(401);
        }

        return view('admin.rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
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
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request)
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
     * @return Factory|View
     */
    public function show(Room $room)
    {
        if (! Gate::allows('view_room')) {
            return abort(401);
        }
        $images = $room->getMedia('rooms');

        return view('admin.rooms.view', compact('room', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Room $room
     * @return Factory|View
     */
    public function edit(Room $room)
    {
        if (! Gate::allows('edit_room')) {
            return abort(401);
        }

        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Room $room
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Room $room)
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
    public function destroy(Room $room)
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
