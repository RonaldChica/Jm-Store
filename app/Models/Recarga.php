<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recarga extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recargas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'playerId',
    ];

    /**
     * Get the related product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

     /**
     * Get the user that owns the recarga.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
