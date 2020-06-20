<?php


namespace App\Search\Filters;


use Carbon\Carbon;
class DateFilterable implements Filter
{
    protected static $fieldName = '';

    public static function apply($builder, $value)
    {
        if (is_array($value)) {
            $from = Carbon::createFromFormat(config('app.date_format'), $value['from'])
                ->startOfDay()
                ->toDateTimeString();

            $to = Carbon::createFromFormat(config('app.date_format'), $value['to'])
                ->endOfDay()
                ->toDateTimeString();
        } else {
            $from = Carbon::createFromFormat(config('app.date_format'), $value)
                ->startOfDay()
                ->toDateTimeString();

            $to = Carbon::createFromFormat(config('app.date_format'), $value)
                ->endOfDay()
                ->toDateTimeString();
        }

        return $builder->whereBetween(static::$fieldName, [$from, $to]);
    }
}