<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class ApiLogsCountTest extends TestCase
{
    public function test()
    {
        $this -> testEmptyRequest();
        $this -> testFullRequest();
    }

    private function testEmptyRequest()
    {
        $this -> json( 'get', 'api/logs/count' ) -> assertStatus( ResponseAlias::HTTP_OK ) -> assertJsonStructure( [
                    'count'
                ] );
    }

    private function testFullRequest()
    {
        $payload = [
            'serviceNames' => 'order-service,invoice-service',
            'statusCode'   => 201,
            'startDate'    => '2022-9-17 11:20',
            'endDate'      => '2022-9-17 23:00',
        ];
        $this -> json( 'get', 'api/logs/count', $payload ) -> assertStatus( ResponseAlias::HTTP_OK ) -> assertJsonStructure( [
                    'count'
                ] );
    }
}
