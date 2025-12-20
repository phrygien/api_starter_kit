<?php

namespace App\Models;

use App\Enums\Enums\V1\CategoryStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasUlids;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
    ];

    protected $casts = [
        'status' => CategoryStatus::class
    ];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()  
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Scope a query to only include active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('status', CategoryStatus::ACTIVE);
    }

    /**
     * Scope a query to only include inactive categories.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', CategoryStatus::INACTIVE);
    }

    /**
     * Check if status is active
     */
    public function isActive()
    {
        return $this->status === CategoryStatus::ACTIVE;
    }

    /**
     * Check if status is inactive
     */
    public function isInactive()
    {
        return $this->status === CategoryStatus::INACTIVE;
    }
}
