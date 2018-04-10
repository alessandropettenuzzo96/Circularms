<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private $available_settings_category = ['routes', 'media', 'users'];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-settings');
    }

    public function index() {
        return view('admin.settings.global');
    }

    public function show($cat) {
        if(!in_array($cat, $this->available_settings_category)) return abort(404);
        $this->authorize('manage-'.$cat);
        return view('admin.settings.'.$cat);
    }

    public function store(Request $request, $category) {
        return app('App\Http\Controllers\\'.ucfirst($category).'Controller')->store($request);
    }

    public function destroy($category, $id) {
        return app('App\Http\Controllers\\'.ucfirst($category).'Controller')->destroy($id);
    }

    public function update(Request $request, $category, $id) {
        return app('App\Http\Controllers\\'.ucfirst($category).'Controller')->update($request, $id);
    }
}
