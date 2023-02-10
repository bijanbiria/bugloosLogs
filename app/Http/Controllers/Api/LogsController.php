<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogsCountRequest;
use App\Http\Resources\LogsCountResource;
use App\Repositories\LogsRepository;

class LogsController extends Controller
{

    /**
     * @var LogsRepository
     */
    public $logsRepository;


    public function __construct()
    {
        $this->logsRepository = new LogsRepository();
    }

    /**
     * @param LogsCountRequest $logsCountRequest
     * @return LogsCountResource
     */
    public function getCount( LogsCountRequest $logsCountRequest): LogsCountResource
    {
        $count = $this->logsRepository->count($logsCountRequest->all());
        return (new LogsCountResource($count));
    }
}
