<?php

namespace App\Http\Controllers;

use App\Navigable;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage-routes');
    }

    public function index() {
        return Navigable::all()->toArray();
    }

    public function store(Request $request) {
        $nav = Navigable::create($request->all(['route', 'method', 'usage', 'priority', 'middleware', 'privileges', 'template', 'controller']));
        return $nav;
    }

    public function destroy($id) {
        return Navigable::destroy($id);
    }

    public function update(Request $request, $id) {
        $nav = Navigable::find($id);
        if($scoped = $request->input('scoped_to')) {
            $nav->$scoped = $request->input($scoped);
            $nav->save();
        } else {
            $nav->update($request->all(['route', 'method', 'usage', 'priority', 'middleware', 'privileges', 'template', 'controller']));
        }
        return $nav;
    }
}
