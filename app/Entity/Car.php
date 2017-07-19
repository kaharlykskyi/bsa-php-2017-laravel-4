<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * Created_at and updated_at fields not needed.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'model',
        'registration_number',
        'year',
        'color',
        'mileage',
        'price',
    ];

    /**
     * Create a re
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}