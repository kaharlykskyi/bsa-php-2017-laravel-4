<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * Created_at and updated_at fields not needed.
     *
     * @var bool
     */
    public $timestamps = false;

    public $fillable = [
        'first_name',
        'last_name',
        'is_active',
    ];

    /**
     * Create a relation, the user can have many cars.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
