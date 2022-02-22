<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Silber\Bouncer\Database\Role;
use Yajra\DataTables\DataTables;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    public function getUsers(): Response
    {
        $has_view = false;
        $has_edit = false;
        $has_delete = false;
        if (auth()->user()->can('view_user')) {
            $has_view = true;
        }
        if (auth()->user()->can('edit_user')) {
            $has_edit = true;
        }
        if (auth()->user()->can('delete_user')) {
            $has_delete = true;
        }

        return DataTables::of(User::query())
            ->addColumn('actions', function ($user) use ($has_view, $has_edit, $has_delete) {
                $view = "";
                if ($has_view) {
                    $view = view('admin.datatables.action-view')
                        ->with(['route' => route('users.show', ['user' => $user->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('admin.datatables.action-edit')
                        ->with(['route' => route('users.edit', ['user' => $user->id])])->render();
                    $view .= $edit;
                }
                if ($has_delete) {
                    $delete = view('admin.datatables.action-delete')
                        ->with(['route' => route('users.destroy', ['user' => $user->id])])->render();
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
        if (! Gate::allows('create_user')) {
            return abort(401);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! Gate::allows('create_user')) {
            return abort(401);
        }

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Gate::allows('create_user')) {
            return abort(401);
        }
        $request->validate([
            'name' => 'required | min:5',
            'email' => 'required |unique:users',
            'password' => 'required | min:6 | confirmed',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        flash('User Created')->success();

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        if (! Gate::allows('view_user')) {
            return abort(401);
        }

        return view('admin.users.view',[
            'user' => $user,
            'abilities' => $user->getAbilities()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        if (! Gate::allows('edit_user')) {
            return abort(401);
        }

        return view('admin.users.edit',[
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(User $user, Request $request): RedirectResponse
    {
        if (! Gate::allows('edit_user')) {
            return abort(401);
        }
        $request->validate([
            'name' => 'required| min:5',
            'email' => 'required| unique:users,email,' . $user->id,
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password == $request->password_confirmation) {
            $user->password = bcrypt($request->password);
        } else {
            flash(__('password and confirm password did not match'))->error();

            return redirect()->action('Admin\UserController@edit', [$user->id]);
        }
        $user->save();
        if ($request->role) {
            $roles = $user->getRoles();
            $user->retract($roles);
            $user->assign($request->role);
        }
        flash('User Info Updated')->success();

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if (! Gate::allows('delete_user')) {
            flash('Not Authorized To delete User')->error();

            return back();
        }
        $user->delete();
        flash('User Deleted')->important();

        return back();
    }
}
