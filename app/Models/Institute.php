<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    public $incrementing = false; // Because primary key is string
    protected $primaryKey = 'InstShort';
    protected $keyType = 'string';

    protected $fillable = [
        'InstShort', 'InstLong', 'InstPlace'
    ];
}
