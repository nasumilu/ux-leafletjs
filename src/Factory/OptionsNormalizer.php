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

use Symfony\Component\OptionsResolver\Options;
use Closure;
use function intval;
use function floatval;

/**
 * 
 */
class OptionsNormalizer
{

    public const TRUTHY_VALUES = [1, '1', true, 'true', 'yes', 'y'];
    public const FALSY_VALUES = [0, '0', false, 'false', 'no', 'n'];

    /**
     * Normalize a value to an integer using php native `intval` function.
     * 
     * @param Options $options
     * @param mixed $value
     * @return int
     */
    public static function castToInt(Options $options, $value): int
    {
        return intval($value);
    }

    /**
     * Normalize a value to a float using php native `floatval` function.
     * 
     * @param Options $options
     * @param mixed $value
     * @return float
     */
    public static function castToFloat(Options $options, $value): float
    {
        return floatval($value);
    }

    /**
     * Normalize a truthy or falsy value to a php bool type.
     * 
     * @param Options $options
     * @param mixed $value
     * @return bool|null when not truth or falsy
     */
    public static function castToBool(Options $options, $value): ?bool
    {
        if (in_array($value, self::TRUTHY_VALUES, true)) {
            return true;
        }

        if (in_array($value, self::FALSY_VALUES, true)) {
            return false;
        }

        return null;
    }

    /**
     * Normalizes a string value to an array of two float values.
     * 
     * @param Options $options
     * @param mixed $value
     * @return mixed
     */
    public static function castWktCoordinateToArray(Options $options, $value)
    {
        if (is_string($value)) {
            $value = array_slice(array_map('floatval', explode(' ', $value)), 0, 2);
        }
        return $value;
    }

    public static function castBoolOrCenter(Options $options, $value)
    {
        if (null !== $bool = self::castToBool($options, $value)) {
            return $bool;
        }

        return $value;
    }

    public static function castToBoundaryBox(Options $options, $value): array
    {
        if (is_string($value)) {
            $value = array_map(static function ($coord) {
                return explode(' ', trim($coord));
            }, explode(',', $value));
        }
        return $value;
    }

    public static function closureFor(string $func): \Closure
    {
        return Closure::fromCallable(OptionsNormalizer::class . "::$func");
    }

}
