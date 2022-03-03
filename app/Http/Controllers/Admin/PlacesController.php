<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Place;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Yajra\DataTables\DataTables;

/**
 * Class PlacesController
 * @package App\Http\Controllers\Admin
 */
class PlacesController extends Controller
{
    public function getPlaces(): JsonResponse
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
            })
            ->rawColumns(['actions'])
            ->make('true');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        if (! Gate::allows('view_place')) {
            return abort(401);
        }

        return view('admin.places.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
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
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Gate::allows('create_place')) {
            return abort(401);
        }

//        $request->validate([
//            'name' => ['required','min:5'],
//            'description' => ['required','min:20'],
//            'travel_description' => ['required','min:20'],
//            'cover' => ['required', 'image','size:1024']
//        ]);
        $place = new Place();
        $place->name = $request->name;
        $place->slug = Str::slug($request->name);
        $place->description = $request->description;
        $place->travel_description = $request->travel_description;
        $place->user_id = auth()->id();
        $place->save();

        $place->addMediaFromRequest('cover')
            ->toMediaCollection('place-cover');

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $place->addMedia($image)
                    ->toMediaCollection('places');
            }
        }

        flash('Created Successfully')->success();

        return redirect(route('places.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Place $place
     * @return View
     */
    public function show(Place $place): View
    {
        if (! Gate::allows('view_place')) {
            return abort(401);
        }
        $images = $place->getMedia('places');

        return view('admin.places.view', [
            'place' => $place,
            'images' => $images,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place $place
     * @return View
     */
    public function edit(Place $place): View
    {
        if (! Gate::allows('edit_place')) {
            return abort(401);
        }

        return view('admin.places.edit', [
            'place' => $place,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Place $place
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Place $place): RedirectResponse
    {
        if (! Gate::allows('edit_place')) {
            return abort(401);
        }
        $place->name = $request->name;
        $place->description = $request->description;
        $place->travel_description = $request->travel_description;
        $place->status = $request->status;
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
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Place $place): RedirectResponse
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
