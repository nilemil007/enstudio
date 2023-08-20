<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoreDataImportController extends Controller
{
    // Core Activation
    public function activation()
    {
        return view('modules.core_data.activation.index');
    }
}
