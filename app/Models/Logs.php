<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'service_name',
        'date_time',
        'rest_type',
        'route',
        'http_version',
        'status_code',
        'file_row_number'
    ];


    /**
     * @param $query
     * @param $serviceName
     * @return mixed
     */
    public function scopeServiceNames( $query, $serviceName)
    {
        return $query->whereIn('service_name', $serviceName);
    }

    /**
     * @param $query
     * @param $statusCode
     * @return mixed
     */
    public function scopeStatusCode( $query, $statusCode)
    {
        return $query->where('status_code', $statusCode);
    }

    /**
     * @param $query
     * @param $date
     * @return mixed
     */
    public function scopeStartDate( $query, $date)
    {
        return $query->where('date_time', '>=', $date);
    }

    /**
     * @param $query
     * @param $date
     * @return mixed
     */
    public function scopeEndDate( $query, $date)
    {
        return $query->where('date_time', '<=', Carbon::parse($date));
    }
}
