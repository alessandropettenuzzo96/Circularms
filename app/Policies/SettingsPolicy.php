<?php
/**
 * Created by PhpStorm.
 * User: n00z
 * Date: 09/04/18
 * Time: 16:33
 */

namespace App\Policies;


use Illuminate\Support\Facades\Gate;

class SettingsPolicy
{
    public static function register() {
        Gate::define('access-settings', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('manage-routes', function ($user) {
            return $user->isRoot();
        });

        Gate::define('manage-media', function ($user) {
            return $user->isRoot();
        });
    }
}