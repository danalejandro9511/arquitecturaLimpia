<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Company;

class TestDatabaseLogHandler extends Command
{
    protected $signature = 'log:test';
    protected $description = 'Test the custom DatabaseLogHandler';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $company = Company::find(1);
        // Log a test message
        Log::channel('database')->info('Empresa actualizada', [
            'model' => 'Company',
            'attributes' => $company->getAttributes(),
        ]);

        $this->info('Test log entry created.');
    }
}
