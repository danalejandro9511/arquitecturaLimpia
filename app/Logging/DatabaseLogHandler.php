<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use App\Models\Log;

class DatabaseLogHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        Log::create([
            'model' => $record->context['model'] ?? 'N/A',
            'event' => $record->message,
            'attributes' => json_encode($record->context['attributes'] ?? []),
        ]);
    }
}