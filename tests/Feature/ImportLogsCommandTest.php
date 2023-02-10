<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\InvalidArgumentException;
use Tests\TestCase;

class ImportLogsCommandTest extends TestCase
{
    public function test() {
//        $this->importWithoutAFile();
        $this->cancelImportLogsCommand();
        $this->importLogsCommand();
    }


    public function importWithoutAFile()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->artisan('import:logs');
    }

    public function cancelImportLogsCommand()
    {
        $this->artisan('import:logs /Volumes/bijac/0-Projects/bugloos/data/logs.txt')
            ->expectsConfirmation('Do you really wish to import logs?', 'no')
            ->expectsOutput('Import cancelled')
            ->assertExitCode(1);
    }

    public function importLogsCommand()
    {
        $this->artisan('import:logs /Volumes/bijac/0-Projects/bugloos/data/logs.txt')
            ->expectsConfirmation('Do you really wish to import logs?', 'yes')
            ->expectsOutput('Starting import')
            ->expectsOutput('Selected File imported Successfully')
            ->assertExitCode(0);
    }
}
