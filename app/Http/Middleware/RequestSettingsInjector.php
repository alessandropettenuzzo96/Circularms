<?php

namespace App\Http\Middleware;

use App\Navigable;
use Closure;

class RequestSettingsInjector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $routeId)
    {
        if($nav = Navigable::find($routeId)) {
            $ss = $nav->settings;
            $settings = [];
            for($i = 0; $i < count($ss); $i++) {
                $s = $ss[$i];
                $settings[$s->name] = $s->value;
            }
            $request->request->add(['settings'=>$settings]);
        }

        return $next($request);
    }
}
