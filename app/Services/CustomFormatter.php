<?php

namespace App\Services;

use Monolog\Formatter\NormalizerFormatter;
use Monolog\LogRecord;


class CustomFormatter extends NormalizerFormatter
{
    public function format(LogRecord $record)
    {
        $result = parent::format($record);
        $result['app_name'] = env('APP_NAME');
        $result['@timestamp'] = $this->normalize($record->datetime);//Needed for Kibana


        return $this->toJson($result) . "\n";
    }
}