<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $primaryKey = 'DesigShort';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];
}
