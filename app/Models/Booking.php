<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    public $guarded = ["id"];


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
