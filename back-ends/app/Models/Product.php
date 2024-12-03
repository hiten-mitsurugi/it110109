<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'starting_price',
        'current_price',
        'admin_id',
        'bidding_ends_at',
        'status',
        'image',
    ];

    // Relationship to the admin who added the product
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
