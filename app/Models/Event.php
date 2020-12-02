<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = true;
    use HasFactory;
    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'takenbies');
    }
}
