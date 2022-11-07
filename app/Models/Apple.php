<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apple extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
        'weight',
        'size'
    ];

    /**
     * Get the quality associated with the Apple.
     */
    public function quality(): object
    {
        return $this->hasOne(AppleQuality::class, 'id', 'quality_id');
    }
}
