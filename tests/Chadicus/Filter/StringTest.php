<?php

namespace Chadicus\Filter;

/**
 * @coversDefaultClass \Chadicus\Filter\String
 */
final class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behvaior of concat()
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
     * Verify argument type checking of concat
     *
     * @test
     * @covers ::concat
     * @dataProvider badConcatData
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
     * Data provider for concatWithInvalidParameters()
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
     * Verify basic behaviour of explode()
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
     * Verify argument type checking of explode
     *
     * @test
     * @covers ::explode
     * @dataProvider badExplodeData
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
     * Data provider for explodeWithInvalidParameters()
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
