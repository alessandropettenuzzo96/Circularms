<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['name', 'value'];
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $table = 'settings';

    public static function get(string $name) {
        $s = Settings::find($name);
        if(!$s) return null;
        return $s->value;
    }

    public static function set(string $name, string $value) {
        $s = Settings::find($name);
        if(!$s) $s = new Settings();
        $s->name = $name;
        $s->value = $value;
        return $s->save();
    }

    public static function del(string $name) {
        $s = Settings::find($name);
        if($s) {
            return $s->delete();
        }
        return true;
    }

    public static function setBool(string $name, bool $value = false) {
        $s = Settings::find($name);
        if(!$s) $s = new Settings();
        $s->name = $name;
        $s->value = $value ? 'true' : 'false';
        return $s->save();
    }

    public static function getBool(string $name) {
        $s = Settings::find($name);
        if(!$s) return null;
        return ($s->value === "true" ? true : ($s->value === 'false' ? false : null));
    }
}
