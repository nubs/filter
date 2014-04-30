<?php
namespace Chadicus\Filter;

/**
 * Unit tests for the \Chadicus\Filter\DateTime class.
 *
 * @coversDefaultClass \Chadicus\Filter\DateTime
 */
final class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic usage of filter().
     *
     * @test
     * @covers ::filter
     *
     * @return void
     */
    public function filter()
    {
        $string = '2014-02-04T11:55:00-0500';
        $dateTime = DateTime::filter($string);

        $this->assertSame(strtotime($string), $dateTime->getTimestamp());
    }

    /**
     * Verify an integer can be filtered.
     *
     * @test
     * @covers ::filter
     *
     * @return void
     */
    public function filterTimestamp()
    {
        $now = time();
        $dateTime = DateTime::filter($now);

        $this->assertSame($now, $dateTime->getTimestamp());
    }

    /**
     * Verify exception is thrown if the $value cannot be filtered.
     *
     * @param mixed $value The value to be filtered.
     *
     * @test
     * @covers ::filter
     * @dataProvider badData
     * @expectedException \Chadicus\Filter\Exception
     *
     * @return void
     */
    public function filterBadData($value)
    {
        DateTime::filter($value);
    }

    /**
     * Data provider for filterBadData().
     *
     * @return array
     */
    public function badData()
    {
        return array(
            '$value is null' => array(null),
            '$value is empty' => array(''),
            '$value is whitespace' => array(" \n\t"),
            '$value is not a string or int' => array(3.0),
            '$value is not a valid date string' => array('not a date string'),
        );
    }
}
