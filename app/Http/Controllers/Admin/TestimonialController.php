<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Yajra\DataTables\DataTables;

/**
 * Class TestimonialController
 * @package App\Http\Controllers\Admin
 */
class TestimonialController extends Controller
{
    public function getTestimonies(): Response
    {
        $has_view = false;
        $has_edit = false;
        $has_delete = false;
        if (auth()->user()->can('view_testimony')) {
            $has_view = true;
        }
        if (auth()->user()->can('edit_testimony')) {
            $has_edit = true;
        }
        if (auth()->user()->can('delete_testimony')) {
            $has_delete = true;
        }

        return DataTables::of(Testimonial::query())
            ->addColumn('actions', function ($testimony) use ($has_view, $has_edit, $has_delete) {
                $view = "";
                if ($has_view) {
                    $view = view('admin.datatables.action-view')
                        ->with(['route' => route('testimonials.show', [$testimony->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('admin.datatables.action-edit')
                        ->with(['route' => route('testimonials.edit', [ $testimony->id])])->render();
                    $view .= $edit;
                }
                if ($has_delete) {
                    $delete = view('admin.datatables.action-delete')
                        ->with(['route' => route('testimonials.destroy', [ $testimony->id])])->render();
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
        if (! Gate::allows('create_testimony')) {
            return abort(401);
        }

        return view('admin.testimonies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! Gate::allows('create_testimony')) {
            return abort(401);
        }

        return view('admin.testimonies.create');
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
        if (! Gate::allows('create_testimony')) {
            return abort(401);
        }
        $testimony = new Testimonial();
        $testimony->name = $request->name;
        $testimony->description = $request->description;
        $testimony->addMediaFromRequest('image')
            ->toMediaCollection('testimony');
        $testimony->save();
        flash('Created Successfully')->success();

        return redirect()->action('Admin\TestimonialController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Testimonial $testimonial
     * @return View
     */
    public function show(Testimonial $testimonial): View
    {
        if (! Gate::allows('view_testimony')) {
            return abort(401);
        }

        return view('admin.testimonies.view',[
            'testimonial' => $testimonial,
            'image' => $testimonial->getFirstMedia('testimony')->getUrl('thumb')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Testimonial $testimonial
     * @return View
     */
    public function edit(Testimonial $testimonial): View
    {
        if (! Gate::allows('edit_testimony')) {
            return abort(401);
        }

        return view('admin.testimonies.edit',[
            'testimonial' => $testimonial,
            'image' => $testimonial->getFirstMedia('testimony')->getUrl('thumb')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Testimonial $testimonial
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        if (! Gate::allows('edit_testimony')) {
            return abort(401);
        }
        $testimonial->name = $request->name;
        $testimonial->description = $request->description;
        $testimonial->status = $request->status;

        if ($request->image) {
            $testimonial->getFirstMedia('testimony')->delete();
            $testimonial->addMediaFromRequest('image')
                ->toMediaCollection('testimony');
        }
        $testimonial->save();
        flash('Updated Successfully');

        return redirect()->action('Admin\TestimonialController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Testimonial $testimonial
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if (! Gate::allows('destroy_testimony')) {
            return abort(401);
        }
        $testimonial->delete();
        flash('Deleted Successfully')->important();

        return back();
    }
}
