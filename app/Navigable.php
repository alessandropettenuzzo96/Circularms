<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Zend\Diactoros\Request;

class Navigable extends Model
{

    protected $guarded = ['id'];

    public function getPrivilegesAttribute($value) {
        return $value ? explode(' ', $value) : null;
    }

    public function getMiddlewareAttribute($value) {
        return $value ? explode(' ', $value) : null;
    }

    public function getSettingsAttribute($value) {
        return json_decode($value);
    }

    public static function register($usage = 'WEB') {
        $pages = Navigable::where('usage', $usage)->where('active', 1)->orderBy('priority', 'desc')->get();
        foreach ($pages as $page) {
            $middleware = ['injector.settings:'.$page->id];
            $middleware = array_merge($middleware, $page->middleware ? $page->middleware : []);
            $privileges = $page->privileges;
            if($page->privileges) {
                $privileges = array_map(function($el){
                    return 'can:'.$el;
                }, $privileges);
                $middleware = array_merge($middleware ? $middleware : [], $privileges);
            }

            Route::match([strtolower($page->method)], $page->route, $page->controller ? $page->controller : function(Request $request) use($page) {
                return view(['template' => $page->template], ['settings'=>$request->input("settings")]);
            })->middleware($middleware);
        }
    }
}
