<?php

namespace App\Http\Controllers;

use App\Models\DdHouse;
use App\Models\Lifting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class LiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('modules.sales_stock.lifting.create', [
            'houses' => DdHouse::all(),
        ]);
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
    public function show(Lifting $lifting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lifting $lifting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lifting $lifting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lifting $lifting)
    {
        //
    }

    /**
     * Move to trash.
     */
    public function trash()
    {
        //
    }

    /**
     * Restore.
     */
    public function restore($id)
    {
        //
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id)
    {
        //
    }

    /**
     * Permanently Delete All.
     */
    public function permanentlyDeleteAll()
    {
        //
    }
}
