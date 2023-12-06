<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $table = 'airlines';

    protected $fillable = [
        'logo',
        'airline',
        'total_seats',
        'flight_number'
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
}
