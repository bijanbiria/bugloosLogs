<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    protected $fillable = [
        'service_name',
        'date_time',
        'rest_type',
        'route',
        'http_version',
        'status_code',
        'file_row_number'
    ];
}
