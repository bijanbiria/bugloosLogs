<?php

namespace App\Repositories;

use App\Http\Requests\LogsCountRequest;
use App\Models\logs;

class LogsRepository extends BaseRepository
{
    /*
     * get count of logs
     * @param LogsCountRequest $logsCountRequest
     * @return int
     */
    public function count($logsCountRequest): int
    {
        return $this->_logsQuery($logsCountRequest)->count();
    }

    /*
     * generate query by inputs
     * @param LogsCountRequest $logsCountRequest
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function _logsQuery($logsCountRequest): \Illuminate\Database\Eloquent\Builder
    {
        $logs = Logs::query()->latest();

        // filter by service name
        if(!empty($logsCountRequest['serviceNames'])) {
            $serviceNames = explode(',', $logsCountRequest['serviceNames']);
            $logs->serviceNames($serviceNames);
        }

        // filter by status code
        if(!empty($logsCountRequest['statusCode'])) {
            $logs->statusCode($logsCountRequest['statusCode']);
        }

        // filter from start date
        if(!empty($logsCountRequest['startDate'])) {
            $logs->startDate($logsCountRequest['startDate']);
        }

        // filter until end date
        if(!empty($logsCountRequest['endDate'])) {
            $logs->endDate($logsCountRequest['endDate']);
        }

        return $logs;
    }
}
