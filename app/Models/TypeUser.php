<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeUser extends Model
{
    use HasFactory;

    protected $table = 'type_users';

    protected $fillable = [
        'airline_id',
        'remain_seat'
    ];

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }
}
