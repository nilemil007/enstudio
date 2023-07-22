<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $routes = Route::latest()->get();
        return view('modules.route.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.route.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
