<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Lists;

class ListController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        $list = Lists::all();
        /*
        return Inertia::render('Application/Mainboard', [
            'listName' => $list
        ]);*/
        /*
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);*/
    }
}
