<?php

namespace App\Http\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;


trait SettingsTrait {

    public function getAllSettings()
    {
        return Setting::firstWhere('user_id', Auth::id());
    }
    
}