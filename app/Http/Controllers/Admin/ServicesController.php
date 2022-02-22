<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Yajra\DataTables\DataTables;

/**
 * Class ServicesController
 * @package App\Http\Controllers\Admin
 */
class ServicesController extends Controller
{
    public function getServices(): Response
    {
        $has_view = false;
        $has_edit = false;
        $has_delete = false;
        if (auth()->user()->can('view_service')) {
            $has_view = true;
        }
        if (auth()->user()->can('edit_users')) {
            $has_edit = true;
        }
        if (auth()->user()->can('delete_users')) {
            $has_delete = true;
        }

        return DataTables::of(Service::query())
            ->addColumn('actions', function ($service) use ($has_view, $has_edit, $has_delete) {
                $view = "";
                if ($has_view) {
                    $view = view('admin.datatables.action-view')
                        ->with(['route' => route('services.show', ['service' => $service->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('admin.datatables.action-edit')
                        ->with(['route' => route('services.edit', ['service' => $service->id])])->render();
                    $view .= $edit;
                }
                if ($has_delete) {
                    $delete = view('admin.datatables.action-delete')
                        ->with(['route' => route('services.destroy', ['service' => $service->id])])->render();
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
        if (! Gate::allows('view_service')) {
            return abort(401);
        }

        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! Gate::allows('create_service')) {
            return abort(401);
        }

        return view('admin.services.create');
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
        if (! Gate::allows('create_service')) {
            return abort(401);
        }
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->addMediaFromRequest('cover')
            ->toMediaCollection('services');
        $service->user_id = auth()->id();
        $service->save();
        flash('created Successfully');

        return redirect()->action('Admin\ServicesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return View
     */
    public function show(Service $service): View
    {
        if (! Gate::allows('view_service')) {
            return abort(401);
        }

        return view('admin.services.view', [
            'service' => $service,
            'image' => $service->getFirstMedia('service')->getUrl('thumb'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return View
     */
    public function edit(Service $service): View
    {
        if (! Gate::allows('edit_service')) {
            return abort(401);
        }

        return view('admin.services.edit', [
            'service' => $service,
            'image' => $service->getFirstMedia('service')->getUrl('thumb'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Service $service
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @return RedirectResponse
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $service->name = $request->name;
        $service->description = $request->description;
        $service->status = $request->status;
        if ($request->cover) {
            $service->getFirstMedia('service')->delete();
            $service->addMediaFromRequest('cover')
                ->toMediaCollection('service');
        }
        $service->save();
        flash('Created Successfully')->success();

        return redirect()->action('Admin\ServicesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return RedirectResponse
     */
    public function destroy(Service $service): RedirectResponse
    {
        if (! Gate::allows('delete_service')) {
            flash('You are Not authorized to perform this action')->error();

            return back();
        }
        $service->delete();
        flash('Deleted Success')->important();

        return back();
    }
}
