<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;
use Yajra\DataTables\DataTables;

/**
 * Class RolesController
 * @package App\Http\Controllers\Admin
 */
class RolesController extends Controller
{
    public function getRoles(): Response
    {
        $has_view = false;
        $has_edit = false;
        $has_delete = false;
        if (auth()->user()->can('view_role')) {
            $has_view = true;
        }
        if (auth()->user()->can('edit_role')) {
            $has_edit = true;
        }
        if (auth()->user()->can('view_role')) {
            $has_delete = true;
        }

        return DataTables::of(Role::query())
            ->addColumn('actions', function ($role) use ($has_view, $has_edit, $has_delete) {
                $view = "";
                if ($has_view) {
                    $view = view('admin.datatables.action-view')
                        ->with(['route' => route('roles.show', ['role' => $role->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('admin.datatables.action-edit')
                        ->with(['route' => route('roles.edit', ['role' => $role->id])])->render();
                    $view .= $edit;
                }
                if ($has_delete) {
                    $delete = view('admin.datatables.action-delete')
                        ->with(['route' => route('roles.destroy', ['role' => $role->id])])->render();
                    $view .= $delete;
                }

                return $view;
            })
            ->editColumn('permissions', function ($roles) {
                $abilities = "";
                foreach ($roles->abilities->pluck('title')  as $permission) {
                    $abilities .= '<span class="badge badge-warning badge-many">' . $permission. '</span>&nbsp';
                }

                return $abilities;
            })
            ->rawColumns(['actions','permissions'])
            ->make('true');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        if (! Gate::allows('view_role')) {
            return abort(401);
        }

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! Gate::allows('create_role')) {
            return abort(401);
        }

        return view('admin.roles.create', [
            'attributes' => Ability::all()->groupBy('entity_type'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Gate::allows('create_role')) {
            return abort(401);
        }

        $request->validate(['name' => 'required|unique:roles|min:5']);

        $role = new Role();
        $role->name = $request->name;
        $role->title = $request->title ?: $request->name;
        $role->save();
        $role->allow($request->input('permissions'));

        flash('Role Created ')->success();

        return redirect()->action('Admin\RolesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function show(Role $role): View
    {
        if (! Gate::allows('view_role')) {
            return abort(401);
        }

        return view('admin.roles.view', [
            'role' => $role,
            'permissions' => $role->abilities->pluck('title')->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        if (! Gate::allows('edit_role')) {
            return abort(401);
        }

        return view('admin.roles.edit', [
            'role' => $role,
            'attributes' => Ability::all()->groupBy('sort-name'),
            'permissions' => $role->abilities->pluck('title')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Role $role
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Role $role, Request $request): RedirectResponse
    {
        if (! Gate::allows('edit_role')) {
            return abort(401);
        }

        $request->validate(['name' => 'required | unique:roles,name,'.$role->id]);

        $role->name = $request->name;
        $role->title = $request->title ?: $request->name;
        $role->save();

        $role->getAbilities()->each(function ($ability) use ($role) {
            $role->disallow($ability);
        });

        $role->allow($request->input('permissions'));

        flash('Role Updated Successfully');

        return redirect()->action('Admin\RolesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Role $role): RedirectResponse
    {
        if (! Gate::allows('delete_role')) {
            flash('You are Not authorized to perform this action')->error();

            return back();
        }
        $role->delete();
        flash('Role Deleted Successfully')->important();

        return back();
    }
}
