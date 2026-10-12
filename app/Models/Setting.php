<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /** Site ki contact settings (DB value ho to wo, warna config ka default) */
    public static function pairs(): array
    {
        $defaults = [
            'phone'   => config('site.phone'),
            'email'   => config('site.email'),
            'address' => config('site.address'),
        ];

        try {
            $db = static::query()->pluck('value', 'key')->all();
        } catch (\Throwable $e) {
            $db = [];
        }

        return array_merge($defaults, array_filter($db, fn ($v) => $v !== null && $v !== ''));
    }

    public static function put(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
