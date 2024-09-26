<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SettingsPages;
use Illuminate\Http\Request;

class SettingPageController extends Controller
{
    public function index()
    {

        $pages = SettingsPages::all();
        foreach ($pages as $page)
        {
            $page->description = strip_tags($page->description);
        }
        return response()->json(responseData($pages, "Acess successful"));
    }
}
