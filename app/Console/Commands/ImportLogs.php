<?php

namespace App\Console\Commands;

use App\Models\logs;
use App\Repositories\ImportLogsFromFileRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:logs {filePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import bugloos logs from file to db';


    protected $importFileRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->importFileRepository = new ImportLogsFromFileRepository();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(!$this->confirm('Do you really wish to import logs?')) {
            $this->error('Import cancelled');
            return 1;
        }
        $this->info('Starting import');

        $result = $this->importFileRepository->import($this->argument('filePath'));
        $this->info($result);
        return 0;
    }
}
