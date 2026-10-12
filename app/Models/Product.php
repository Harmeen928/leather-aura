<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'line1', 'line2', 'description', 'image', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }

    public function getHeadline1Attribute(): string
    {
        return strtoupper($this->line1 ?: $this->name);
    }

    public function getHeadline2Attribute(): string
    {
        return strtoupper((string) $this->line2);
    }

    public function getGhostAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->name));
        return strtoupper(end($parts) ?: '');
    }
}
