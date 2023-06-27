<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_number',
        'student_id',
        'amount',
        'due_date',
        'fee_type',
        'status',
    ];
}
