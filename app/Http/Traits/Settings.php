<?php

namespace App\Http\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;


trait Settings {

    public static function getSettings()
    {
        return Setting::firstWhere('user_id', Auth::id());
    }

}