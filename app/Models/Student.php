<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nfc_id',
        'name',
        'email',
        'course',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
