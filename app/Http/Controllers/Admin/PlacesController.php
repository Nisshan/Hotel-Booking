<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Place;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Psy\Util\Str;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Yajra\DataTables\DataTables;

/**
 * Class PlacesController
 * @package App\Http\Controllers\Admin
 */
class PlacesController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getPlaces()
    {
        $has_view = false;
        $has_edit = false;
        $has_delete = false;
        if (auth()->user()->can('view_place')) {
            $has_view = true;
        }
        if (auth()->user()->can('edit_place')) {
            $has_edit = true;
        }
        if (auth()->user()->can('delete_place')) {
            $has_delete = true;
        }

        return DataTables::of(Place::query())
            ->addColumn('actions', function ($place) use ($has_view, $has_edit, $has_delete) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($has_view) {
                    $view = view('admin.datatables.action-view')
                        ->with(['route' => route('places.show', ['place' => $place->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('admin.datatables.action-edit')
                        ->with(['route' => route('places.edit', ['place' => $place->id])])->render();
                    $view .= $edit;
                }
                if ($has_delete) {
                    $delete = view('admin.datatables.action-delete')
                        ->with(['route' => route('places.destroy', ['place' => $place->id])])->render();
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
        if (! Gate::allows('view_place')) {
            return abort(401);
        }

        return view('admin.places.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('create_place')) {
            return abort(401);
        }

        return view('admin.places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request)
    {
        if (! Gate::allows('create_place')) {
            return abort(401);
        }
        $place = new Place();
        $place->name = $request->name;
        $place->slug = Str::slug($request->name);
        $place->description = $request->description;
        $place->travel_description = $request->travel_description;
        $place->user_id = auth()->id();
        $place->addMediaFromRequest('cover')
            ->toMediaCollection('place-cover');

        foreach ($request->file('images') as $image) {
            $place->addMedia($image)
                ->toMediaCollection('places');
        }
        $place->save();
        flash('Created Successfull')->success();

        return redirect()->action('Admin\PlacesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Place $place
     * @return Response
     */
    public function show(Place $place)
    {
        if (! Gate::allows('view_place')) {
            return abort(401);
        }
        $images = $place->getMedia('places');

        return view('admin.places.view', compact('place', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place $place
     * @return Response
     */
    public function edit(Place $place)
    {
        if (! Gate::allows('edit_place')) {
            return abort(401);
        }

        return view('admin.places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Place $place
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Place $place)
    {
        if (! Gate::allows('edit_place')) {
            return abort(401);
        }
        $place->name = $request->name;
        $place->description = $request->description;
        $place->travel_description = $request->travel_description;
        $place->status = $request->status || 1;
        if ($request->cover) {
            $place->getFirstMedia('place-cover')->delete();
            $place->addMediaFromRequest('cover')
                ->toMediaCollection('place-cover');
        }
        if ($request->images) {
            $place->clearMediaCollection('places');
            foreach ($request->file('images') as $image) {
                $place->addMedia($image)
                    ->toMediaCollection('places');
            }
        }
        $place->save();
        flash('Updated Successfully')->success();

        return redirect()->action('Admin\PlacesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Place $place
     * @return Response
     * @throws \Exception
     */
    public function destroy(Place $place)
    {
        if (! Gate::allows('delete_place')) {
            flash('Not Authorized To delete Place')->error();

            return back();
        }
        $place->delete();
        flash('Deleted Successfully')->important();

        return back();
    }
}
