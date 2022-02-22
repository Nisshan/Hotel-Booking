<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index() : View
    {
        return view('admin.dashboard');
    }
}
