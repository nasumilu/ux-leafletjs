<?php

/*
 * Copyright 2021 mlucas.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Nasumilu\UX\Leafletjs\Factory;

use Closure;
use InvalidArgumentException;
use function is_string;
use function is_numeric;
use function count;
use function array_filter;
use function array_map;
use function explode;
use function array_merge;
use function in_array;

/**
 * 
 */
class OptionsValidator
{

    public static function centerOrBool($value): bool
    {
        return in_array($value,
                array_merge(['center'], OptionsNormalizer::TRUTHY_VALUES, OptionsNormalizer::FALSY_VALUES),
                true);
    }

    static function boundaryBox($value): bool
    {
        if (is_string($value)) {
            $value = array_map(static function ($coord) {
                return explode(' ', trim($coord));
            }, explode(',', $value));
        }
        return 4 === count(array_filter(
                                array_merge($value[0] ?? [], $value[1] ?? []),
                                'is_numeric'));
    }

    public static function wktCoordinate($value): bool
    {
        if (is_string($value)) {
            $value = explode(' ', $value);
        }
        return 2 === count(array_filter($value, 'is_numeric'));
    }

    public static function greaterThanZero($value): bool
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException("Value must be numeric, found $value!");
        }
        return $value > 0;
    }

    public static function greaterThanEqualToZero($value): bool
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException("Value must be numeric, found $value!");
        }
        return $value >= 0;
    }

    public static function closureFor(string $func): Closure
    {
        return Closure::fromCallable(OptionsValidator::class . "::$func");
    }

}
