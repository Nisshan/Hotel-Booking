<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\Testimonial;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

/**
 * Class ServicesController
 * @package App\Http\Controllers\Admin
 */
class ServicesController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getServices()
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
                $edit = "";
                $delete = "";
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
     * @return Response
     */
    public function index()
    {
        if(!Gate::allows('view_service')){
            return abort(401);
        }
        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(!Gate::allows('create_service')){
            return abort(401);
        }
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create_service')){
            return abort(401);
        }
        $service = new Service;
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
     * @return Factory|View
     */
    public function show(Service $service)
    {
        if(!Gate::allows('view_service')){
            return abort(401);
        }
        $image = $service->getFirstMedia('service')->getUrl('thumb');
        return view('admin.services.view',compact('service','image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Factory|View
     */
    public function edit(Service $service)
    {
        if(!Gate::allows('edit_service')){
            return abort(401);
        }
        $image = $service->getFirstMedia('service')->getUrl('thumb');
        return view('admin.services.edit',compact('service','image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Service $service
     * @return void
     */
    public function update(Request $request, Service $service)
    {
        $service->name = $request->name;
        $service->description = $request->description;
        $service->status = $request->status;
        if($request->cover){
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
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Service $service)
    {
        if(!Gate::allows('delete_service')){
            flash('You are Not authorized to perform this action')->error();
            return back();
        }
        $service->delete();
        flash('Deleted Success')->important();
        return back();
    }
}
