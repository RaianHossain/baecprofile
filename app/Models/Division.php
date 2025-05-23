<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Division extends Model
{
    use HasFactory;

    protected $primaryKey = 'DivShort';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'DivShort',
        'DivLong',
        'InstShort',
    ];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'InstShort', 'InstShort');
    }
}
