<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employees";

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'DesigShort', 'DesigShort');
    }
    public function institute()
    {
        return $this->belongsTo(Institute::class, 'InstShort', 'InstShort');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'DivShort', 'DivShort');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
