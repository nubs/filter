<?php

namespace Chadicus\Filter;

/**
 * Unit tests for the \Chadicus\Filter\String class.
 *
 * @coversDefaultClass \Chadicus\Filter\String
 */
final class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behvaior of concat().
     *
     * @test
     * @covers ::concat
     *
     * @return void
     */
    public function concat()
    {
        $this->assertSame('prefixstringsuffix', String::concat('string', 'prefix', 'suffix'));
    }

    /**
     * Verify argument type checking of concat.
     *
     * @param string $value           The starting string value.
     * @param string $prefix          The value to prepend to $value.
     * @param string $suffix          The value to append to $value.
     * @param string $expectedMessage The exception message to expect from calling concat with the given params.
     *
     * @test
     * @covers ::concat
     * @dataProvider badConcatData
     *
     * @return void
     */
    public function concatWithInvalidParameters($value, $prefix, $suffix, $expectedMessage)
    {
        try {
            String::concat($value, $prefix, $suffix);
            $this->fail('No exception thrown');
        } catch (\InvalidArgumentException $e) {
            $this->assertSame($expectedMessage, $e->getMessage());
        }
    }

    /**
     * Data provider for concatWithInvalidParameters().
     *
     * @return array
     */
    public function badConcatData()
    {
        return array(
            'non string value' => array(true, 'prefix', 'suffix', '$value was not a string'),
            'non string prefix' => array('value', array(), 'suffix', '$prefix was not a string'),
            'non string suffix' => array('value', 'prefix', 1.0, '$suffix was not a string'),
        );
    }

    /**
     * Verify basic behaviour of explode().
     *
     * @test
     * @covers ::explode
     *
     * @return void
     */
    public function explode()
    {
        $this->assertSame(array('a', 'string', 'with', 'spaces'), String::explode('a string with spaces'));
    }

    /**
     * Verify argument type checking of explode.
     *
     * @param string  $value           The input string.
     * @param string  $delimiter       The boundary string.
     * @param integer $limit           The limit.
     * @param string  $expectedMessage The exception message to expect from calling explode with the given params.
     *
     * @test
     * @covers ::explode
     * @dataProvider badExplodeData
     *
     * @return void
     */
    public function explodeWithInvalidParameters($value, $delimiter, $limit, $expectedMessage)
    {
        try {
            String::explode($value, $delimiter, $limit);
            $this->fail('No exception thrown');
        } catch (\InvalidArgumentException $e) {
            $this->assertSame($expectedMessage, $e->getMessage());
        }
    }

    /**
     * Data provider for explodeWithInvalidParameters().
     *
     * @return array
     */
    public function badExplodeData()
    {
        return array(
            'non string value' => array(true, ' ', 1, '$value was not a string'),
            'non string delimiter' => array('value', array(), 1, '$delimiter was not a non-empty string'),
            'empty string delimiter' => array('value', '', 1, '$delimiter was not a non-empty string'),
            'non integer limit' => array('value', ' ', true, '$limit was not an integer'),
        );
    }
}
