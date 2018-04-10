<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isRoot() {
        return $this->role === 'CREATOR';
    }

    public function isAdmin() {
        return $this->isRoot() || $this->role === 'ADMIN';
    }

    public function hasAdminbar() {
        if(!$this->role) return false;
        $roles = Settings::get('roles_with_adminbar');
        if(!$roles) {
            $roles = ['CREATOR', 'ADMIN'];
        }
        return in_array($this->role, $roles);
    }

}
