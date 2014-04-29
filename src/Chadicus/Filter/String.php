<?php
namespace Chadicus\Filter;

/**
 * Filter methods for strings.
 */
class String
{
    /**
     * Method to concat the give prefix and suffix to the given string value.
     *
     * @param string $value  The starting string value.
     * @param string $prefix The value to prepend to $value.
     * @param string $suffix The value to append to $value.
     *
     * @return string
     *
     * @throws \InvalidArgumentException Thrown if $value is not a string.
     * @throws \InvalidArgumentException Thrown if $prefix is not a string.
     * @throws \InvalidArgumentException Thrown if $suffix is not a string.
     */
    public static function concat($value, $prefix = '', $suffix = '')
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value was not a string');
        }

        if (!is_string($prefix)) {
            throw new \InvalidArgumentException('$prefix was not a string');
        }

        if (!is_string($suffix)) {
            throw new \InvalidArgumentException('$suffix was not a string');
        }

        return "{$prefix}{$value}{$suffix}";
    }

    /**
     * Split a string by the specified delimiter. @see \explode().
     *
     * This method exists as a filter because filters require the string to be the first argument in the method call.
     *
     * @param string  $value     The input string.
     * @param string  $delimiter The boundary string.
     * @param integer $limit     If set and positive, the returned array will contain a maximum of limit elements with
     *                           the last element containing the rest of string.
     *                           If set and negative, all components except the last -limit are returned.
     *                           If zero, then this is treated as 1.
     *
     * @return array
     *
     * @throws \InvalidArgumentException Thrown if $value is not a string.
     * @throws \InvalidArgumentException Thrown if $delimiter is not a string or is empty.
     * @throws \InvalidArgumentException Thrown if $limit is not an integer.
     */
    public static function explode($value, $delimiter = ' ', $limit = PHP_INT_MAX)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value was not a string');
        }

        if (!is_string($delimiter) || $delimiter == '') {
            throw new \InvalidArgumentException('$delimiter was not a non-empty string');
        }

        if (!is_int($limit)) {
            throw new \InvalidArgumentException('$limit was not an integer');
        }

        return explode($delimiter, $value, $limit);
    }
}
