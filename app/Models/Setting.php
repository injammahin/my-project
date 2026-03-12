<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function allCached(): array
    {
        return Cache::rememberForever('settings.all', function () {
            return self::pluck('value', 'key')->toArray();
        });
    }

    public static function set(string $key, $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('settings.all');
    }

    public static function get(string $key, $default = null)
    {
        $all = self::allCached();
        return $all[$key] ?? $default;
    }
}
