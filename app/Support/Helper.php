<?php

if (!function_exists('makeCarbon')) {
    function makeCarbon($obj, $format)
    {
        if ($obj instanceof Carbon\Carbon) {
            return $obj;
        }

        if (is_string($obj)) {
            return Carbon::createFromFormat($format, $obj);
        }

        throw new Exception('given object must be an instace-of Carbon or a string');
    }
}

if (!function_exists('carbonFromDate')) {
    function carbonFromDate($obj)
    {
        $format = config('app.date_out_format');

        return makeCarbon($obj, $format);
    }
}

if (!function_exists('carbonFromDateTime')) {
    function carbonFromDateTime($obj)
    {
        $format = config('app.datetime_out_format');

        return makeCarbon($obj, $format);
    }
}

if (!function_exists('carbonFromTime')) {
    function carbonFromTime($obj)
    {
        $format = config('app.time_out_format');

        return makeCarbon($obj, $format);
    }
}

if (!function_exists('toFormat')) {
    function toFormat($obj, $format)
    {
        if ($obj instanceof Carbon\Carbon) {
            return $obj->format($format);
        }

        return $obj;
    }
}

if (!function_exists('toTimeFormat')) {
    function toTimeFormat($obj)
    {
        return toFormat($obj, config('app.time_out_format'));
    }
}

if (!function_exists('toDateFormat')) {
    function toDateFormat($obj)
    {
        return toFormat($obj, config('app.date_out_format'));
    }
}

if (!function_exists('toMonthFormat')) {
    function toMonthFormat($obj)
    {
        return toFormat($obj, config('app.month_out_format'));
    }
}

if (!function_exists('toDateTimeFormat')) {
    function toDateTimeFormat($obj)
    {
        return toFormat($obj, config('app.datetime_out_format'));
    }
}
