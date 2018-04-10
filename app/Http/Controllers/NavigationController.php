<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Navigable;

class NavigationController extends Controller
{

    public function index()
    {
        $page = Navigable::where('route', '/')->where('active', 1)->first();
        if(!$page) {
            $page = new Navigable();
            $page->route = '/';
            $page->template = 'theme.index';
        }
        return view($page->template)->with('page', $page);
    }
}
