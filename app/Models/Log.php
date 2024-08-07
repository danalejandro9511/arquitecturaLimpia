<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class Log extends Model
{
    protected $fillable = ['model', 'attributes', 'event'];

    /* public static function write(array $record)
    {
        self::create([
            'model' => $record['context']['model'],
            'attributes' => json_encode($record['context']['attributes']),
            'event' => $record['message'],
        ]);
    } */
}

/* class DatabaseLogHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        //dd('Record in DatabaseLogHandler:', $record); 
        Log::write([
            'message' => $record->message,
            'context' => $record->context,
        ]);
    }
} */